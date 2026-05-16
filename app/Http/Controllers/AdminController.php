<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil semua data booking, beserta relasi nama paketnya, diurutkan dari yang paling baru (terakhir dipesan)
        $bookings = Booking::with('campingPackage')->latest()->get();

        // Menghitung total estimasi pendapatan dari semua pesanan yang ada
        $totalRevenue = $bookings->sum('total_price');

        // Mengirim data ke tampilan admin.blade.php
        return view('admin', compact('bookings', 'totalRevenue'));
    }
}