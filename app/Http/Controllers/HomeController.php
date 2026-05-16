<?php

namespace App\Http\Controllers;

use App\Models\CampingPackage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil semua data paket camping dari database PostgreSQL
        $packages = CampingPackage::all();

        // Mengirimkan data tersebut ke dalam view home.blade.php
        return view('home', compact('packages'));
    }
}