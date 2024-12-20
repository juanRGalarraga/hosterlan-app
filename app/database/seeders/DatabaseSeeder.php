<?php

namespace Database\Seeders;

use App\Models\Phone;
use App\Enums\Publication\RentTypeEnum;
use App\Models\AvailableDay;
use App\Models\RentType;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Owner;
use App\Models\Publication;
use App\Models\Reservation;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        RentType::factory()
            ->count(count(RentTypeEnum::cases()))
            ->create();

        User::factory()
            ->count(10)
            ->hasOwner(1)
            ->hasPhones(1)
            ->create();

        User::factory()
            ->count(10)
            ->hasGuest(1)
            ->hasPhones(1)
            ->create();

        User::factory()
            ->count(1)
            ->hasGuest(1)
            ->hasPhones(1)
            ->create([
                'email' => 'guest@example.com',
                'password' => Hash::make('password'),
            ]);

        //This user is for only development purposes.
        //You can use it to login and test the application.
        User::factory()
            ->count(1)
            ->hasOwner(1)
            ->hasPhones(1)
            ->create([
                'email' => 'owner@example.com',
                'password' => Hash::make('password'),
                'is_dev' => true
            ]);
        
        Publication::factory()
            ->count(10)
            ->hasPictures(3)
            ->hasRentType(1)
            ->hasAvailableDays(rand(1, 5))
            ->create();

        Reservation::factory()
            ->count(rand(2, 10))
            ->create();
    }
}
