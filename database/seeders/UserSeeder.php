<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Gedoy',
            'email' => 'admin@gedoy.com',
            'password' => Hash::make('rahasia123'), // Ini password adminnya
        ]);
    }
}