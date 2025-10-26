<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image_path',
        'tnc'
    ];
}
