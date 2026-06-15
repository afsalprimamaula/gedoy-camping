<?php

namespace App\Http\Controllers;

use App\Models\CampingPackage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil paket camping yang aktif dari database
        $packages = CampingPackage::where('is_active', true)->get();

        // Mengambil seluruh gambar galeri
        $galleryImages = \App\Models\GalleryImage::orderBy('sort_order')->latest()->get();

        return view('home', compact('packages', 'galleryImages'));
    }
}