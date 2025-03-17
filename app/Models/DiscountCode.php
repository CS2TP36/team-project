<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class DiscountCode extends Model
{
    protected $table = 'discount_codes';

    // If you want mass assignment, you can define fillable fields
    protected $fillable = [
        'start',
        'expiry',
        'code',
        'percent_off',
    ];

    /**
     * Checks if the current time is within the start-expiry range.
     */
    public function isValid(): bool
    {
        $now = Carbon::now();
        return $now->greaterThanOrEqualTo($this->start)
            && $now->lessThanOrEqualTo($this->expiry);
    }

    /**
     * Applies the discount percentage to the given total.
     * For example, if percent_off = 20, subtract 20% from $total.
     */
    public function applyDiscount(float $total): float
    {
        return $total - ($total * ($this->percent_off / 100));
    }
}