<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'price' => rand(1,9),
            // 'price' => $this->faker->randomNumbers(2),
            // 'price' => $this->faker->randomFloat(2,2,15),
            'image' => '',
            'short_descr' => $this->faker->realText(100,2),
            'full_descr' => $this->faker->realText(1000,5),
        ];
    }
}
