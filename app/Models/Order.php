<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Shipping;
use App\Models\IndividualOrder;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_date',
        'order_status',
        'order_total_price',
        'shipping_id',
        'transaction_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function individualOrders()
    {
        return $this->hasMany(IndividualOrder::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }
}
