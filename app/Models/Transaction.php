<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';  // Fixing table name

    protected $fillable = [
        'transaction_amount',
        'transaction_info',
        'transaction_status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'transaction_id');
    }
}
