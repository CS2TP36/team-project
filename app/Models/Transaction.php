<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Transaction extends Model
{
    use HasFactory;

    //The table associated with the model
    protected $table = 'transaction';

    // The attributes that are mass assignable.
    protected $fillable = [
        'order_id',
        'transaction_amount',
        'transaction_info',
        'transaction_status',
    ];
     
    //Get the order associated with the transaction.
     
    public function order()
    {
        return $this->belongsTo(Orders::class);
    }
}