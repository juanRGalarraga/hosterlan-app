<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publication>
 */
class PublicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price'=>fake()->numberBetween(100000,200000),
            'ubication'=> fake()->address(),
            'description'=>fake()->sentence(),
            'room_count'=>fake()->numberBetween(1,10),
            'pets'=>fake()->boolean(),
            'number_people'=> fake()->numberBetween(1,10),
        ];
    }
}
