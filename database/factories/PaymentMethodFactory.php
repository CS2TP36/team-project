<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PaymentMethod;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMethod>
 */
class PaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = PaymentMethod::class;

    public function definition(): array
    {
        return [
            'user_id'      => User::factory(),
            'card_name'    => $this->faker->name,
            'card_number'  => $this->faker->numerify('################'),
            'expiry_month' => $this->faker->numberBetween(1, 12),
            'expiry_year'  => $this->faker->numberBetween(23, 30),
            'cvv'          => $this->faker->numerify('###'),
        ];
    }
}
