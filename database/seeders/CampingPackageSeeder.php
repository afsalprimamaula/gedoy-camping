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
            'name' => 'Paket Camping 4 Orang',
            'slug' => 'river-camp',
            'description' => 'Berada tepat di pinggir sungai. Rasakan sensasi tidur ditemani gemericik air yang menenangkan serta akses dekat ke Curug Ciangin.',
            'price' => 350000, 
            'capacity' => 4,
            'features' => ['papan dex alas tenda', 'sleeping bag', 'matras', 'lampu tenda', 'cooking set', 'sarapan']
        ]);

        CampingPackage::create([
            'name' => 'Sewa Tempat',
            'slug' => 'pinus-camp',
            'description' => 'Sewa area kavling/lahan camping eksklusif di Ciater. Bawa tenda sendiri dan nikmati ketenangan alam terbuka yang sejuk.',
            'price' => 40000, 
            'capacity' => 6,
            'features' => ['papan dex alas tenda', 'listrik dan lampu area', 'parkir gratis']
        ]);

        CampingPackage::create([
            'name' => 'Villa Kabin Kayu',
            'slug' => 'kabin-kayu',
            'description' => 'Waktunya healing ke alam Subang! Nikmati pengalaman menginap di kabin kayu pedesaan dua lantai yang estetik dengan balkon gantung. Kapasitas hingga 3 orang, pas banget buat liburan bareng keluarga atau sirkel kamu! Nikmati malam yang syahdu di bawah hangatnya lampu hias, dengan udara sejuk khas Desa Wisata Cibeusi, Ciater.',
            'price' => 400000, 
            'capacity' => 3,
            'features' => ['kabin kayu 2 lantai', 'balkon gantung', 'toilet modern terpisah', 'area parkir', 'kolam renang', 'nasi liwet & gurame bakar']
        ]);
    }
}