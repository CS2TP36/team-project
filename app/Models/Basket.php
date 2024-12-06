<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'session_id', 'product_id', 'size', 'quantity'];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function getTotalPrice(): float|int
    {
        $singularPrice = $this->product()['price'];
        return $this['quantity'] * $singularPrice;
    }
}

