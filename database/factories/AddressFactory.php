<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Address;
use App\Models\User;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{

    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_id'       => User::factory(),
            'full_name'     => $this->faker->name,
            'address_line1' => $this->faker->streetAddress,
            'town_city'     => $this->faker->city,
            'post_code'     => $this->faker->postcode,
            'phone_number'  => $this->faker->phoneNumber,
        ];
    }
}
