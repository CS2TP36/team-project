<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Category;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => $this->faker->word(),
            'price'       => $this->faker->randomFloat(2, 1, 100),
            'stock'       => $this->faker->numberBetween(0, 20),
            'colour'      => $this->faker->safeColorName(),
            'description' => $this->faker->sentence(),
            'mens'        => $this->faker->boolean(),
            'category_id' => Category::factory()->create()->id, // Ensures a valid category exists


        ];
    }
}


