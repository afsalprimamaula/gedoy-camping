<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun khusus Pengelola/Admin
        User::create([
            'name' => 'Admin Gedoy',
            'email' => 'admin@gedoy.com',
            'password' => Hash::make('rahasia123'),
            'role' => 'admin', // Role diset admin
        ]);

        // 2. Akun contoh Pengunjung/User biasa
        User::create([
            'name' => 'Ahmad Pengunjung',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123'),
            'role' => 'user', // Role diset user
        ]);
    }
}