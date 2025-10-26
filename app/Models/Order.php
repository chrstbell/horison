<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'room_number',
        'user_id',
        'order_time',
        'status',
        'subtotal',
        'tax',
        'total',
        'customer_note',
        'completed_time',
        'completed_by'
    ];

    protected $casts = [
        'order_time' => 'datetime:Y-m-d H:i:s',
        'completed_time' => 'datetime:Y-m-d H:i:s',
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2'
    ];

    public $timestamps = false;

    /**
     * Prepare a date for array / JSON serialization.
     */
    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    // Relationships
    public function items()
    {
        return $this->hasMany(\App\Models\OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
