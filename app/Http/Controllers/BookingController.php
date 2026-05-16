<?php

namespace App\Http\Controllers;

use App\Models\CampingPackage;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    // 1. Menampilkan halaman form booking
    public function show(CampingPackage $package)
    {
        return view('booking', compact('package'));
    }

    // 2. Menangkap data form, menghitung, dan menyimpan ke PostgreSQL
    public function store(Request $request, CampingPackage $package)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|max:20',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'total_guests' => 'required|integer|min:1|max:' . $package->capacity,
        ]);

        $checkIn = Carbon::parse($request->check_in_date);
        $checkOut = Carbon::parse($request->check_out_date);
        $days = $checkIn->diffInDays($checkOut);

        $totalPrice = $package->price * $days;

        $bookingCode = 'GDY-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        Booking::create([
            'booking_code' => $bookingCode,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'camping_package_id' => $package->id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'total_guests' => $request->total_guests,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Pesanan Anda untuk ' . $package->name . ' berhasil dibuat! Tim kami akan menghubungi Anda segera.');
    }
}