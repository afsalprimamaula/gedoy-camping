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
            'price' => 250000, 
            'capacity' => 4,
            // Cukup gunakan Array [], jangan gunakan json_encode()
            'features' => ['Tenda Premium', 'Private Campfire', 'Kamar Mandi Air Panas', 'Akses Curug Ciangin']
        ]);

        CampingPackage::create([
            'name' => 'Pinus Camp',
            'slug' => Str::slug('Pinus Camp'),
            'description' => 'Cocok untuk Anda yang mencari ketenangan absolut. Area luas yang dinaungi pohon pinus rindang, sangat ideal untuk Glamping keluarga.',
            'price' => 400000, 
            'capacity' => 6,
            // Cukup gunakan Array [], jangan gunakan json_encode()
            'features' => ['Tenda Glamping Besar', 'Kasur & Sleeping Bag', 'Listrik & Lampu Area', 'Private Campfire Area']
        ]);
    }
}