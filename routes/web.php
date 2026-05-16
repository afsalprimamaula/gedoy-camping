<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Route untuk halaman utama (Landing Page)
Route::get('/', [HomeController::class, 'index'])->name('home');