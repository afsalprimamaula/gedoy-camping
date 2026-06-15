<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'name' => 'Nasi Goreng Kampung Premium',
                'description' => 'Nasi goreng aromatik dengan bumbu tradisional, sate ayam sabut kelapa, telur mata sapi, dan kerupuk gendar gurih.',
                'price' => 55000,
                'category' => 'Makanan Utama',
                'status' => 'tersedia',
                'image_path' => 'menu_nasi_goreng.jpg',
            ],
            [
                'name' => 'Sate Maranggi Ciater',
                'description' => 'Sate sapi khas Jawa Barat yang empuk dimarinasi ketumbar manis, disajikan dengan sambal tomat pedas segar dan ketan bakar.',
                'price' => 75000,
                'category' => 'Makanan Utama',
                'status' => 'tersedia',
                'image_path' => 'menu_sate_maranggi.jpg',
            ],
            [
                'name' => 'Iga Bakar Madu Hutan',
                'description' => 'Iga sapi premium yang empuk dibakar dengan olesan madu hutan alami Ciater, disajikan dengan sup hangat dan sambal ijo pedas.',
                'price' => 95000,
                'category' => 'Makanan Utama',
                'status' => 'tersedia',
                'image_path' => 'menu_iga_bakar.jpg',
            ],
            [
                'name' => 'Pisang Bakar Keju Caramel',
                'description' => 'Pisang raja bakar manis dengan parutan keju cheddar melimpah dan siraman saus karamel hangat buatan koki kami.',
                'price' => 35000,
                'category' => 'Dessert',
                'status' => 'tersedia',
                'image_path' => 'menu_pisang_bakar.jpg',
            ],
            [
                'name' => 'Roti Bakar Bandung Special',
                'description' => 'Roti bakar tebal dipanggang margarin gurih, diisi cokelat Belgian premium leleh dan keju parut gurih.',
                'price' => 32000,
                'category' => 'Dessert',
                'status' => 'tersedia',
                'image_path' => 'menu_roti_bakar.jpg',
            ],
            [
                'name' => 'Wedang Ronde Jahe Merah',
                'description' => 'Minuman jahe merah bakar hangat berkhasiat dengan bola ronde isi kacang tanah manis, kolang-kaling, dan roti tawar lembut.',
                'price' => 25000,
                'category' => 'Minuman',
                'status' => 'tersedia',
                'image_path' => 'menu_wedang_ronde.jpg',
            ],
            [
                'name' => 'Es Kelapa Muda Jeruk',
                'description' => 'Air kelapa muda segar murni dipadu perasan jeruk peras alami, gula tebu cair, dan serutan daging kelapa muda lembut.',
                'price' => 28000,
                'category' => 'Minuman',
                'status' => 'tersedia',
                'image_path' => 'menu_kelapa_jeruk.jpg',
            ],
            [
                'name' => 'Teh Sereh Lemon Hangat',
                'description' => 'Seduhan teh premium harum dipadukan dengan batang sereh geprek segar dan irisan jeruk lemon segar penenang pikiran.',
                'price' => 22000,
                'category' => 'Minuman',
                'status' => 'tersedia',
                'image_path' => 'menu_teh_sereh.jpg',
            ]
        ];

        foreach ($menus as $menu) {
            \App\Models\RestaurantMenu::create($menu);
        }
    }
}
