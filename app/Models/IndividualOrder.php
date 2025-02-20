<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;

class IndividualOrder extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'size'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): Product
    {
        return Product::all()->where('id', $this->product_id)->first();
    }

    public function getSubtotal(): float|int
    {
        return $this->quantity * $this->price; // Added helper to calculate subtotal
    }
}
