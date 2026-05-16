<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CampingPackage;
use Illuminate\Support\Str;

class CampingPackageSeeder extends Seeder
{
    public function run(): void
    {
        CampingPackage::create([
            'name' => 'River Camp',
            'slug' => Str::slug('River Camp'),
            'description' => 'Berada tepat di pinggir sungai. Rasakan sensasi tidur ditemani gemericik air yang menenangkan serta akses dekat ke Curug Ciangin.',
            'price' => 250000, // Contoh harga Rp 250.000 / malam
            'capacity' => 4,
            'features' => json_encode(['Tenda Premium', 'Private Campfire', 'Kamar Mandi Air Panas', 'Akses Curug Ciangin'])
        ]);

        CampingPackage::create([
            'name' => 'Pinus Camp',
            'slug' => Str::slug('Pinus Camp'),
            'description' => 'Cocok untuk Anda yang mencari ketenangan absolut. Area luas yang dinaungi pohon pinus rindang, sangat ideal untuk Glamping keluarga.',
            'price' => 400000, // Contoh harga Rp 400.000 / malam
            'capacity' => 6,
            'features' => json_encode(['Tenda Glamping Besar', 'Kasur & Sleeping Bag', 'Listrik & Lampu Area', 'Private Campfire Area'])
        ]);
    }
}