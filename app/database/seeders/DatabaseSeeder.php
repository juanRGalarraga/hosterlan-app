<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Publication\RentTypeEnum;
use App\Models\RentType;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Owner;
use App\Models\Publication;
use App\Models\Picture;
use App\Models\AvailableDay;
use Database\Factories\RentTypeFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use League\CommonMark\Util\ArrayCollection;

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
            ->count(1)
            ->hasGuest(1)
            ->hasPhones(1)
            ->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ]);

        Publication::factory()
            ->count(10)
            ->hasPictures(rand(1,5))
            ->hasRentType(1)
            ->hasAvailableDays(rand(1, 5))
            ->create();
    }
}
