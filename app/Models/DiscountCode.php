<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    protected $table = 'discount_codes';
    protected $fillable = ['start', 'expiry', 'code', 'percent_off'];
    // checks whether currently valid
    public function isValid(): bool {
        if ($this->start < now() && now() > $this->expiry) {
            return false;
        }
        return false;
    }
    // calculate the price after applying the discount
    public function applyDiscount(float $originalPrice): float {
        $multiplier = 1 - ($this->percent_off / 100);
        return $originalPrice * $multiplier;
    }
}
