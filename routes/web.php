<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminRestaurantController;
use App\Http\Controllers\Admin\AdminRestaurantOrderController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CartController;

// Rute Tampilan Pengunjung (Publik)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/booking/{package:slug}', [BookingController::class, 'show'])->name('booking.show');
Route::post('/booking/{package:slug}', [BookingController::class, 'store'])->name('booking.store');

// Rute Autentikasi (Login & Register)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// ---- INI RUTE YANG SEBELUMNYA TERLEWAT ----
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
// -------------------------------------------

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Panel Admin (TERKUNCI - Hanya untuk yang sudah login)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard utama
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::patch('/booking/{booking}/status', [AdminController::class, 'updateStatus'])->name('updateStatus');
    Route::delete('/booking/{booking}', [AdminController::class, 'destroy'])->name('destroy');

    // Manajemen Paket
    Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
    Route::post('/packages', [PackageController::class, 'store'])->name('packages.store');
    Route::put('/packages/{package}', [PackageController::class, 'update'])->name('packages.update');
    Route::delete('/packages/{package}', [PackageController::class, 'destroy'])->name('packages.destroy');

    // Laporan Keuangan
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');

    // Data Pelanggan
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');

    // Galeri & Konten
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::delete('/gallery/{image}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    // Pengaturan Sistem
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Manajemen Restoran
    Route::get('/restaurant', [AdminRestaurantController::class, 'index'])->name('restaurant.index');
    Route::post('/restaurant', [AdminRestaurantController::class, 'store'])->name('restaurant.store');
    Route::put('/restaurant/{menu}', [AdminRestaurantController::class, 'update'])->name('restaurant.update');
    Route::patch('/restaurant/{menu}/toggle', [AdminRestaurantController::class, 'toggleStatus'])->name('restaurant.toggle');
    Route::delete('/restaurant/{menu}', [AdminRestaurantController::class, 'destroy'])->name('restaurant.destroy');

    // Manajemen Pesanan Restoran
    Route::get('/restaurant-orders', [AdminRestaurantOrderController::class, 'index'])->name('restaurant_orders.index');
    Route::patch('/restaurant-orders/{order}/status', [AdminRestaurantOrderController::class, 'updateStatus'])->name('restaurant_orders.updateStatus');
    Route::delete('/restaurant-orders/{order}', [AdminRestaurantOrderController::class, 'destroy'])->name('restaurant_orders.destroy');
});

// Rute Customer Portal (User Dashboard)
Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::patch('/password', [UserController::class, 'updatePassword'])->name('updatePassword');
});

// Rute Restoran & Cart
Route::get('/restaurant', [RestaurantController::class, 'index'])->name('restaurant.index');

Route::get('/restaurant/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/restaurant/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/restaurant/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/restaurant/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/restaurant/checkout', [CartController::class, 'checkout'])->name('cart.checkout');