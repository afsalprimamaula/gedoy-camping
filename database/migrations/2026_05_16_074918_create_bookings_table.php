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
            Schema::create('bookings', function (Blueprint $table) {
                $table->id();
                $table->string('booking_code')->unique(); // Kode unik transaksi: misal GDY-20260516-001
                $table->string('customer_name');
                $table->string('customer_email');
                $table->string('customer_phone');
                
                // Relasi Foreign Key ke tabel camping_packages (Prinsip Relasional PostgreSQL)
                $table->foreignId('camping_package_id')->constrained('camping_packages')->onDelete('cascade');
                
                $table->date('check_in_date');
                $table->date('check_out_date');
                $table->integer('total_guests');
                $table->integer('total_price');
                $table->string('status')->default('pending'); // Status: pending, confirmed, cancelled
                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
