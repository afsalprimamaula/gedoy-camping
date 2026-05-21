<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController; // Panggil AuthController

// Rute Tampilan Pengunjung (Publik)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/booking/{package:slug}', [BookingController::class, 'show'])->name('booking.show');
Route::post('/booking/{package:slug}', [BookingController::class, 'store'])->name('booking.store');

// Rute Autentikasi (Publik)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Panel Admin (TERKUNCI - Hanya untuk yang sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::patch('/admin/booking/{booking}/status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
    Route::delete('/admin/booking/{booking}', [AdminController::class, 'destroy'])->name('admin.destroy');
});