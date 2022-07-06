<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uniqid' => $this->faker->regexify('[A-Z]{3}').$this->faker->regexify('[A-Z0-9]{5}'), // overwrited in seeders/OrdersSeeder.php
            'user_id' => 1,
            'fullname' => $this->faker->name(),
            'address' => $this->faker->streetAddress(),
            'zipcode' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'amount' => 0, // overwrited in seeders/OrdersSeeder.php
            'card_number' => $this->faker->creditCardNumber(),
            'card_expiration' => $this->faker->creditCardExpirationDateString(),
            'card_cvv' => sprintf("%03d",rand(0,999)),
            'cart' => '', // overwrited in seeders/OrdersSeeder.php
        ];
    }
}
