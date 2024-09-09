<?php

namespace Database\Factories;

use App\Enums\Publication\AvailableDayEnum;
use App\Models\Publication;
use App\Models\PublicationDayAvailable;
use App\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReservationGuest>
 */
class PublicationDayAvailableGuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'publication_id' => Publication::factory(),
            'publication_day_available_id' => PublicationDayAvailable::factory(),
            'guest_id' => Guest::factory(),
            'state' => AvailableDayEnum::Pending->name
        ];
    }
}
