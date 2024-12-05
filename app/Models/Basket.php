<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'session_id', 'product_id', 'size', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

