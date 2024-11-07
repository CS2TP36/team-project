<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'review'
    ];
    // returns user for given review
    public function user() {
        return $this->belongsTo(User::class);
    }
    // returns the product for given review
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
