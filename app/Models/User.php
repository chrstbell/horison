<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'username',
        'password',
        'role',
        'room_number',
        'is_active',
        'login_expiry',
        'login_time',
    ];
}
