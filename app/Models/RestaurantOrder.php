<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantOrder extends Model
{
    protected $fillable = [
        'user_id',
        'tenda_number',
        'delivery_time',
        'subtotal',
        'tax',
        'grand_total',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(RestaurantOrderItem::class);
    }
}
