<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Shipping extends Model
{
    protected $table = 'shipping';
    protected $primaryKey = 'id';

    protected $fillable = [
        'shipping_date',
        'delivery_date',
        'home_address',
        'tracking_number',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
