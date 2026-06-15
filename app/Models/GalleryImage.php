<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = [
        'path',
        'original_name',
        'size',
        'mime_type',
        'sort_order',
    ];
}
