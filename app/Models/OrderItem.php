<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'menu_id',
        'quantity',
        'price',
        'notes'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2'
    ];

    public $timestamps = false;

    // Relationships
    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class);
    }

    public function menu()
    {
        return $this->belongsTo(\App\Models\MenuCategory::class, 'menu_id');
    }
}
