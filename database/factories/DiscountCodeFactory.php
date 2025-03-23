<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use App\Models\DiscountCode;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DiscountCode>
 */
class DiscountCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = DiscountCode::class;

    public function definition(): array
    {
        return [
            'start'       => Carbon::now()->subDay(),  
            'expiry'      => Carbon::now()->addDays(7),
            'code'        => strtoupper($this->faker->lexify('??????')),
            'percent_off' => $this->faker->numberBetween(5, 50),

        ];
    }
}
