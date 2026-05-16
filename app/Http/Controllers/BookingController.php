<?php

namespace App\Http\Controllers;

use App\Models\CampingPackage;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function show(CampingPackage $package)
    {
        return view('booking', compact('package'));
    }

    public function store(Request $request, CampingPackage $package)
    {
        // 1. Pesan Peringatan Custom (Bahasa Indonesia)
        $messages = [
            'customer_name.required' => 'Nama lengkap wajib diisi.',
            'customer_phone.regex' => 'Format nomor HP tidak valid. Gunakan awalan 08 atau 628 dengan panjang 10-14 angka.',
            'check_in_date.after_or_equal' => 'Tanggal Check-in tidak boleh di masa lalu.',
            'check_out_date.after' => 'Tanggal Check-out harus setelah tanggal Check-in.',
            'total_guests.max' => 'Jumlah tamu melebihi batas maksimal kapasitas tenda.',
        ];

        // 2. Logika Validasi Ketat (Termasuk Regex Nomor Telepon Indonesia)
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => ['required', 'regex:/^(08|628|\+628)[0-9]{7,11}$/'], 
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'total_guests' => 'required|integer|min:1|max:' . $package->capacity,
        ], $messages);

        // 3. Logika Mengecek Ketersediaan Tenda (Anti Double-Booking)
        $isBooked = Booking::where('camping_package_id', $package->id)
            ->where('check_in_date', '<', $request->check_out_date)
            ->where('check_out_date', '>', $request->check_in_date)
            ->exists();

        if ($isBooked) {
            // Jika tanggal bentrok dengan pesanan orang lain, kembalikan dengan pesan error
            return redirect()->back()
                ->withInput() // Mengembalikan data yang sudah diketik agar tidak perlu ketik ulang
                ->with('error', 'Maaf, ' . $package->name . ' sudah terpesan (Full) pada tanggal tersebut. Silakan pilih tanggal lain.');
        }

        // 4. Proses Simpan ke Database (Jika Lulus Semua Ujian di Atas)
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

        return redirect()->route('home')->with('success', 'Pesanan Anda untuk ' . $package->name . ' berhasil dibuat! Tim kami akan segera menghubungi Anda.');
    }
}