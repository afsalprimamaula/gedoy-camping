<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Menyuruh Laravel mengeksekusi kedua file seeder ini secara berurutan
        $this->call([
            UserSeeder::class,           // Menyuntikkan akun Admin & User
            CampingPackageSeeder::class, // Menyuntikkan data paket Pinus & River Camp
        ]);
    }
}