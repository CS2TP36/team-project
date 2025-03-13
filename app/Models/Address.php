<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'phone_number',
        'post_code',
        'address_line1',
        'address_line2',
        'town_city',
        'county',
        'is_default',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}