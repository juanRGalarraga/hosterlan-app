<?php

namespace Database\Factories;

use App\Enums\Publication\PublicationState;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PublicationAvailableDay;
use \DateInterval;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PublicationAvailableDay>
 */
class PublicationAvailableDayFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $since = fake()->dateTimeThisYear();
        $to = $since->add(DateInterval::createFromDateString('7 day'));
        return [
            'since'=> $since,
            'to'=> $to,
            'state'=> fake()->randomElement(PublicationState::forMigration())
        ];
    }
}
