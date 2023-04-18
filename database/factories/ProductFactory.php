<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'details' => $this->faker->paragraph,
            'category_id' => rand(1, 12),
            'user_id' => rand(1, 2),
        ];
    }
}
