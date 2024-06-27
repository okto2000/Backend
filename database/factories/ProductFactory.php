<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'product_name' => fake()->name(),
            'image' => fake()->imageUrl(),
            'id_category' => fake()->numberBetween(1, 5),
            'price' => fake()->numberBetween(100000, 1000000),
        ];
    }
}
