<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 1. Menampilkan Dashboard
    public function index()
    {
        $bookings = Booking::with('campingPackage')->latest()->get();
        
        // PROFESIONAL: Pendapatan hanya dihitung dari pesanan yang sudah "Dikonfirmasi"
        $totalRevenue = $bookings->where('status', 'confirmed')->sum('total_price');
        
        // Menghitung jumlah antrean yang belum divalidasi
        $pendingCount = $bookings->where('status', 'pending')->count();

        return view('admin', compact('bookings', 'totalRevenue', 'pendingCount'));
    }

    // 2. Logika Mengubah Status Pesanan
    public function updateStatus(Request $request, Booking $booking)
    {
        // Pastikan input valid (hanya boleh confirmed atau cancelled)
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        // Update database
        $booking->update([
            'status' => $request->status
        ]);

        $pesan = $request->status == 'confirmed' ? 'dikonfirmasi ✅' : 'dibatalkan ❌';

        return redirect()->route('admin.index')->with('success', 'Pesanan atas nama ' . $booking->customer_name . ' berhasil ' . $pesan);
    }

    // 3. Logika Menghapus Data Permanen
    public function destroy(Booking $booking)
    {
        $nama = $booking->customer_name;
        $booking->delete();

        return redirect()->route('admin.index')->with('success', 'Data pesanan ' . $nama . ' berhasil dihapus dari sistem 🗑️');
    }
}