<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantMenu extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'status',
        'image_path'
    ];
}
