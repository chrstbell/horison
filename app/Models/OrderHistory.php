<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    protected $table = 'order_history';

    protected $fillable = [
        'order_id',
        'status',
        'changed_by',
        'change_time',
        'notes'
    ];

    protected $casts = [
        'change_time' => 'datetime'
    ];

    public $timestamps = false;
}
