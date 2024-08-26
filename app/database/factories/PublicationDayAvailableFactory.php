<?php

namespace Database\Factories;

use App\Enums\Publication\StateEnum;
use App\Models\Publication;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PublicationDayAvailable;
use \DateInterval;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PublicationDayAvailable>
 */
class PublicationDayAvailableFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $since = fake()->dateTimeThisYear();
        $to = (clone $since)->modify('+7 days');
        return [
            'publication_id' => Publication::factory(),
            'since'=> $since,
            'to'=> $to,
            'state'=> fake()->randomElement(StateEnum::forMigration())
        ];
    }
}
