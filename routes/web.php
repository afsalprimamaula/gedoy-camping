<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController; // Tambahkan baris ini untuk memanggil BookingController

// Route untuk halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route untuk halaman form booking (Ini yang sebelumnya terlewat)
Route::get('/booking/{package:slug}', [BookingController::class, 'show'])->name('booking.show');

// Route untuk menerima dan menyimpan data booking (POST)
Route::post('/booking/{package:slug}', [BookingController::class, 'store'])->name('booking.store');

// Panggil AdminController di bagian atas (di bawah BookingController)
use App\Http\Controllers\AdminController;

// Rute untuk Panel Admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');