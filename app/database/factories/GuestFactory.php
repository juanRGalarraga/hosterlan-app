<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guest>
 */
class GuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'name'=> fake()->name(),
        'username'=> fake()->username(),
        'password'=> bcrypt(fake()->password()),
        'email'=> fake()->unique()->safeEmail(),
        'options'=>[],
        'rating'=>fake()->randomFloat(0,10)
        ];
    }
}
