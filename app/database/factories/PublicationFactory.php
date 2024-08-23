<?php

namespace Database\Factories;

use Database\Factories\RentTypeFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\Publication\PublicationState;
use App\Enums\Publication\RentTypeEnum;
use App\Models\RentType;

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
            'number_people'=> fake()->numberBetween(1,10),
            'rent_type_id' => RentType::inRandomOrder()->first()->id,
            'state'=> fake()->randomElement(RentTypeEnum::forMigration()),
        ];
    }
}
