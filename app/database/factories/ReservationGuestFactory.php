<?php

namespace Database\Factories;

use App\Enums\Publication\AvailableDayEnum;
use App\Models\Guest;
use App\Models\PublicationDayAvailable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReservationGuest>
 */
class ReservationGuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'publication_day_available_id' => PublicationDayAvailable::factory(),
            'guest_id' => Guest::factory(),
            'state'=> AvailableDayEnum::Pending->name,
        ];
    }
}
