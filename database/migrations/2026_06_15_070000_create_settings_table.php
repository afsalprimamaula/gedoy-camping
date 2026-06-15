<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->string('key')->primary();
                $table->text('value')->nullable();
                $table->timestamps();
            });
        }

        // Seeding default settings
        $defaults = [
            'web_name' => 'Gedoy Camping Park',
            'web_slogan' => 'Glamping Premium di Tepi Sungai & Alam Terbuka Ciater',
            'whatsapp_number' => '6281222099317',
            'tel_number' => '+62 812-2209-9317',
            'address' => 'Kawasan Nagrak, Kecamatan Ciater, Kabupaten Subang',
            'instagram_url' => 'https://www.instagram.com/',
            'maps_link' => 'https://maps.app.goo.gl/xxx',
            'contact_email' => 'info@gedoycamping.com',
            'dp_percentage' => '30',
            'bank_name' => 'BCA',
            'bank_account' => '1393019842',
            'bank_recipient' => 'CV Gedoy Wisata Indonesia',
            'sys_status' => 'open', // open / closed
            'sys_closed_message' => 'Mohon maaf, Gedoy Camping Park sedang tutup sementara untuk pemeliharaan area kemah.',
        ];

        foreach ($defaults as $key => $val) {
            DB::table('settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $val, 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
