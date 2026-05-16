<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // Mengizinkan Laravel mengisi kolom-kolom ini
    protected $fillable = [
        'booking_code', 'customer_name', 'customer_email', 'customer_phone',
        'camping_package_id', 'check_in_date', 'check_out_date', 'total_guests',
        'total_price', 'status'
    ];

    // Mendefinisikan relasi ke model CampingPackage
    public function campingPackage()
    {
        // Memberitahu Laravel bahwa setiap 1 Booking terhubung ke 1 CampingPackage
        return $this->belongsTo(CampingPackage::class);
    }
}