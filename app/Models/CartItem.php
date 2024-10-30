<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'dish_id',
        'name',
        'price',
        'quantity',
        'image',
        'restaurant_id',
        'discount',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}

