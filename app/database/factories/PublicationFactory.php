<?php

namespace Database\Factories;

use App\Models\RentType;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\Publication\PublicationState;
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
            'title' => fake()->sentence(3),
            'price'=>fake()->randomFloat(2,0,8),
            'ubication'=> fake()->address(),
            'description'=>fake()->sentence(),
            'room_count'=>fake()->numberBetween(1,10),
            'bathroom_count'=>fake()->numberBetween(1,10),
            'pets'=>fake()->boolean(),
            'rent_type_id' => RentType::factory(),
            'number_people'=> fake()->numberBetween(1,10),
            'state'=> fake()->randomElement(PublicationState::forMigration()),
        ];
    }
}
