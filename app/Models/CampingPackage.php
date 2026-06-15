<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampingPackage extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'price', 'capacity', 'features', 'icon', 'is_active', 'image_path'];

    // Mengonversi otomatis data JSON dari PostgreSQL menjadi Array di Laravel
    protected $casts = [
        'features' => 'array',
    ];
}