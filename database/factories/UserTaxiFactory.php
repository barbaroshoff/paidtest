<?php

namespace Database\Factories;

use App\Models\Taxi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserTaxiFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'taxi_id' => Taxi::factory(),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'color' => $this->faker->numberBetween(1, 3),
            'trial_color' => $this->faker->boolean(),
        ];
    }
    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
