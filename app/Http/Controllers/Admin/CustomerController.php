<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        // Get all users with booking count
        // We load bookings from the bookings table matching by email
        $customers = User::latest()->get()->map(function ($user) {
            // Count bookings by matching email
            $bookingsCount = Booking::where('customer_email', $user->email)->count();
            $latestBooking = Booking::where('customer_email', $user->email)->latest()->first();

            $user->bookings_count = $bookingsCount;
            // Try to get phone from the bookings table since User model may not have it
            $user->phone = $latestBooking?->customer_phone ?? null;
            $user->bookings = collect($latestBooking ? [$latestBooking] : []);
            return $user;
        });

        return view('admin.customers', compact('customers'));
    }
}
