<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Show the customer dashboard with their booking history.
     */
    public function dashboard()
    {
        $user = Auth::user();

        // Fetch all bookings belonging to this user (matched by email)
        $bookings = Booking::with('campingPackage')
            ->where('customer_email', $user->email)
            ->latest()
            ->get();

        // Fetch all F&B restaurant orders belonging to this user
        $restaurantOrders = \App\Models\RestaurantOrder::with('items.menu')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('user.dashboard', compact('bookings', 'restaurantOrders'));
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('Password saat ini tidak sesuai.');
                }
            }],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'different:current_password',
            ],
        ], [
            'password.required'   => 'Password baru wajib diisi.',
            'password.min'        => 'Password baru minimal 8 karakter.',
            'password.confirmed'  => 'Konfirmasi password tidak cocok.',
            'password.different'  => 'Password baru harus berbeda dari password saat ini.',
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.dashboard')
                         ->with('success', 'Password berhasil diperbarui! Akun Anda sekarang lebih aman 🔐');
    }
}
