<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\DancePlace;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan dashboard admin
    public function index()
    {
        // Menghitung seluruh booking
        $totalBookings = Booking::count();

        // Menghitung booking hari ini
        $todayBookings = Booking::whereDate(
            'booking_date',
            today()
        )->count();

        // Menghitung seluruh studio
        $totalStudios = DancePlace::count();

        // Mengambil 5 booking terbaru
        $recentBookings = Booking::with('dancePlace')
            ->latest()
            ->take(5)
            ->get();

        return view('admin-dashboard', compact(
            'totalBookings',
            'todayBookings',
            'totalStudios',
            'recentBookings'
        ));
    }
}