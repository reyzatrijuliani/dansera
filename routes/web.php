<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DancePlaceController;

// Halaman awal
Route::get('/', function () {
    return redirect()->route('login');
});

// Login dan register
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

// Halaman setelah login
Route::middleware('auth')->group(function () {

    // Dashboard berdasarkan role
    Route::get('/dashboard', function (Request $request) {
        $user = $request->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('welcome');
    })->name('dashboard');

    // Halaman khusus admin
    Route::middleware('admin')->group(function () {

        Route::get('/admin/dashboard', [AdminController::class, 'index'])
            ->name('admin.dashboard');

        // Kelola booking
        Route::get('/bookings', [BookingController::class, 'list'])
            ->name('bookings.index');

        Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])
            ->name('bookings.edit');

        Route::put('/bookings/{id}', [BookingController::class, 'update'])
            ->name('bookings.update');

        Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])
            ->name('bookings.destroy');

        // Lihat dan verifikasi bukti pembayaran
        Route::get('/bookings/{id}/payment-proof', [BookingController::class, 'paymentProof'])
            ->name('bookings.payment-proof');

        Route::patch('/bookings/{id}/payment', [BookingController::class, 'reviewPayment'])
            ->name('bookings.payment.review');

        // Kelola studio
        Route::get('/admin/studios', [DancePlaceController::class, 'index'])
            ->name('admin.studios.index');

        Route::get('/admin/studios/create', [DancePlaceController::class, 'create'])
            ->name('admin.studios.create');

        Route::post('/admin/studios', [DancePlaceController::class, 'store'])
            ->name('admin.studios.store');

        Route::get('/admin/studios/{id}/edit', [DancePlaceController::class, 'edit'])
            ->name('admin.studios.edit');

        Route::put('/admin/studios/{id}', [DancePlaceController::class, 'update'])
            ->name('admin.studios.update');

        Route::delete('/admin/studios/{id}', [DancePlaceController::class, 'destroy'])
            ->name('admin.studios.destroy');
    });

    // Halaman khusus user
    Route::middleware('user')->group(function () {

        // Form booking
        Route::get('/booking', [BookingController::class, 'index'])
            ->name('booking.create');

        // Simpan booking
        Route::post('/booking', [BookingController::class, 'store'])
            ->name('booking.store');

        // Riwayat booking milik user
        Route::get('/my-bookings', [BookingController::class, 'myBookings'])
            ->name('bookings.mine');

        // Form edit booking milik user
        Route::get('/my-bookings/{id}/edit', [BookingController::class, 'editMine'])
            ->name('bookings.mine.edit');

        // Simpan perubahan booking milik user
        Route::put('/my-bookings/{id}', [BookingController::class, 'updateMine'])
            ->name('bookings.mine.update');

        // Batalkan booking milik user
        Route::patch('/my-bookings/{id}/cancel', [BookingController::class, 'cancelMine'])
            ->name('bookings.mine.cancel');

        // Upload bukti pembayaran oleh user
        Route::post('/my-bookings/{id}/payment-proof', [BookingController::class, 'uploadPaymentProof'])
            ->name('bookings.payment.upload');
    });

    // Logout untuk admin dan user
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});