<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\Publication\RentType;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RentType>
 */
class RentTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(RentType::forMigration()),
            'description' => ''
        ];
    }
}
