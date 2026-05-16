<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('camping_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Paket: misal River Camp, Pinus Camp
            $table->string('slug')->unique(); // URL clean: misal river-camp
            $table->text('description'); // Deskripsi lengkap paket
            $table->integer('price'); // Harga paket (menggunakan integer lebih aman untuk performa)
            $table->integer('capacity'); // Kapasitas maksimal orang
            $table->json('features')->nullable(); // Fasilitas tambahan dalam bentuk JSON array
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camping_packages');
    }
};
