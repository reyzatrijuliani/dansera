<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\DancePlace;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    // USER MELIHAT FORM BOOKING
    public function index()
    {
        $dancePlaces = DancePlace::all();

        return view('booking', compact('dancePlaces'));
    }

    // USER MEMBUAT BOOKING
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dance_place_id' => 'required|exists:dance_places,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:1|max:12',
        ]);

        if ($this->hasConflict(
            $validated['dance_place_id'],
            $validated['booking_date'],
            $validated['start_time'],
            $validated['duration']
        )) {
            return back()
                ->withInput()
                ->withErrors([
                    'start_time' => 'Jadwal studio sudah dipesan pada waktu tersebut.',
                ]);
        }

        Booking::create([
            'user_id' => Auth::id(),
            'name' => Auth::user()->name,
            'dance_place_id' => $validated['dance_place_id'],
            'booking_date' => $validated['booking_date'],
            'start_time' => $validated['start_time'],
            'duration' => $validated['duration'],
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        return redirect()->route('booking.create')
            ->with('success', 'Booking berhasil dibuat! Silakan lanjutkan pembayaran melalui QRIS di riwayat booking.');
    }

    // ADMIN MELIHAT SEMUA BOOKING
    public function list()
    {
        $bookings = Booking::with(['dancePlace', 'user'])
            ->latest()
            ->get();

        return view('bookings', compact('bookings'));
    }

    // ADMIN MEMBUKA FORM EDIT BOOKING
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $dancePlaces = DancePlace::all();

        return view('edit-booking', compact('booking', 'dancePlaces'));
    }

    // ADMIN MEMPERBARUI BOOKING
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dance_place_id' => 'required|exists:dance_places,id',
            'booking_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:1|max:12',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        if ($this->hasConflict(
            $validated['dance_place_id'],
            $validated['booking_date'],
            $validated['start_time'],
            $validated['duration'],
            $booking->id
        )) {
            return back()
                ->withInput()
                ->withErrors([
                    'start_time' => 'Jadwal studio sudah dipesan pada waktu tersebut.',
                ]);
        }

        $booking->update($validated);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking berhasil diperbarui.');
    }

    // ADMIN MENGHAPUS BOOKING
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->payment_proof_path) {
            Storage::disk('local')->delete($booking->payment_proof_path);
        }

        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Booking berhasil dihapus.');
    }

    // USER MELIHAT RIWAYAT BOOKING MILIKNYA
    public function myBookings()
    {
        /** @var User $user */
        $user = Auth::user();

        $bookings = $user->bookings()
            ->with('dancePlace')
            ->latest()
            ->get();

        return view('my-bookings', compact('bookings'));
    }

    // USER MEMBUKA FORM EDIT BOOKING MILIKNYA
    public function editMine($id)
    {
        /** @var User $user */
        $user = Auth::user();

        $booking = $user->bookings()->findOrFail($id);

        if (!$this->canModifyPendingBooking($booking)) {
            return redirect()->route('bookings.mine')
                ->with('error', 'Booking hanya bisa diedit sebelum bukti pembayaran dikirim.');
        }

        $dancePlaces = DancePlace::all();

        return view('edit-my-booking', compact('booking', 'dancePlaces'));
    }

    // USER MEMPERBARUI BOOKING MILIKNYA
    public function updateMine(Request $request, $id)
    {
        /** @var User $user */
        $user = Auth::user();

        $booking = $user->bookings()->findOrFail($id);

        if (!$this->canModifyPendingBooking($booking)) {
            return redirect()->route('bookings.mine')
                ->with('error', 'Booking hanya bisa diedit sebelum bukti pembayaran dikirim.');
        }

        $validated = $request->validate([
            'dance_place_id' => 'required|exists:dance_places,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:1|max:12',
        ]);

        if ($this->hasConflict(
            $validated['dance_place_id'],
            $validated['booking_date'],
            $validated['start_time'],
            $validated['duration'],
            $booking->id
        )) {
            return back()
                ->withInput()
                ->withErrors([
                    'start_time' => 'Jadwal studio sudah dipesan pada waktu tersebut.',
                ]);
        }

        $booking->update($validated);

        return redirect()->route('bookings.mine')
            ->with('success', 'Booking berhasil diperbarui.');
    }

    // USER MEMBATALKAN BOOKING MILIKNYA
    public function cancelMine($id)
    {
        /** @var User $user */
        $user = Auth::user();

        $booking = $user->bookings()->findOrFail($id);

        if (!$this->canModifyPendingBooking($booking)) {
            return redirect()->route('bookings.mine')
                ->with('error', 'Booking hanya bisa dibatalkan sebelum bukti pembayaran dikirim.');
        }

        $booking->update([
            'status' => 'cancelled',
        ]);

        return redirect()->route('bookings.mine')
            ->with('success', 'Booking berhasil dibatalkan.');
    }

    // USER MENGUNGGAH BUKTI PEMBAYARAN
    public function uploadPaymentProof(Request $request, $id)
    {
        /** @var User $user */
        $user = Auth::user();

        $booking = $user->bookings()->findOrFail($id);

        if ($booking->status === 'cancelled') {
            return redirect()->route('bookings.mine')
                ->with('error', 'Booking yang dibatalkan tidak dapat dibayar.');
        }

        if (!in_array($booking->payment_status, ['unpaid', 'rejected'], true)) {
            return redirect()->route('bookings.mine')
                ->with('error', 'Bukti pembayaran sudah dikirim atau pembayaran sudah lunas.');
        }

        $validated = $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $newPath = $validated['payment_proof']->store('payment-proofs', 'local');

        if ($booking->payment_proof_path) {
            Storage::disk('local')->delete($booking->payment_proof_path);
        }

        $booking->update([
            'payment_proof_path' => $newPath,
            'payment_status' => 'waiting_verification',
            'payment_verified_at' => null,
        ]);

        return redirect()->route('bookings.mine')
            ->with('success', 'Bukti pembayaran terkirim. Menunggu verifikasi Admin.');
    }

    // ADMIN MELIHAT FILE BUKTI PEMBAYARAN
    public function paymentProof($id)
    {
        $booking = Booking::findOrFail($id);

        abort_unless($booking->payment_proof_path, 404);

        $filePath = Storage::disk('local')->path($booking->payment_proof_path);

        abort_unless(is_file($filePath), 404);

        return response()->file($filePath);
    }

    // ADMIN MEMVERIFIKASI PEMBAYARAN
    public function reviewPayment(Request $request, $id)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:paid,rejected',
        ]);

        $booking = Booking::findOrFail($id);

        if (
            $booking->status === 'cancelled'
            || $booking->payment_status !== 'waiting_verification'
            || !$booking->payment_proof_path
        ) {
            return redirect()->route('bookings.index')
                ->with('error', 'Booking ini tidak memiliki bukti pembayaran yang bisa diverifikasi.');
        }

        $booking->update([
            'payment_status' => $validated['payment_status'],
            'payment_verified_at' => $validated['payment_status'] === 'paid'
                ? now()
                : null,
        ]);

        $message = $validated['payment_status'] === 'paid'
            ? 'Pembayaran berhasil diverifikasi.'
            : 'Pembayaran ditolak. User dapat mengunggah ulang bukti pembayaran.';

        return redirect()->route('bookings.index')
            ->with('success', $message);
    }

    // CEK APAKAH BOOKING PENDING MASIH BOLEH DIEDIT ATAU DIBATALKAN
    private function canModifyPendingBooking(Booking $booking): bool
    {
        return $booking->status === 'pending'
            && ($booking->payment_status ?? 'unpaid') === 'unpaid'
            && !$booking->payment_proof_path;
    }

    // MEMERIKSA BENTROK JADWAL STUDIO
    private function hasConflict(
        $dancePlaceId,
        $bookingDate,
        $startTime,
        $duration,
        $exceptId = null
    ) {
        $bookings = Booking::where('dance_place_id', $dancePlaceId)
            ->whereDate('booking_date', $bookingDate)
            ->whereIn('status', ['pending', 'confirmed'])
            ->when($exceptId, function ($query) use ($exceptId) {
                $query->where('id', '!=', $exceptId);
            })
            ->get();

        $newStart = $this->timeToMinutes($startTime);
        $newEnd = $newStart + ($duration * 60);

        foreach ($bookings as $booking) {
            $oldStart = $this->timeToMinutes($booking->start_time);
            $oldEnd = $oldStart + ($booking->duration * 60);

            if ($newStart < $oldEnd && $newEnd > $oldStart) {
                return true;
            }
        }

        return false;
    }

    // MENGUBAH JAM MENJADI MENIT
    private function timeToMinutes($time)
    {
        [$hours, $minutes] = explode(':', $time);

        return ((int) $hours * 60) + (int) $minutes;
    }
}