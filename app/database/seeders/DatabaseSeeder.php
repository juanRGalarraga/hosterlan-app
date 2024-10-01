<?php

namespace Database\Seeders;

use App\Models\Phone;
use App\Enums\Publication\RentTypeEnum;
use App\Models\RentType;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Owner;
use App\Models\Publication;
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

        $user = User::factory()
            ->count(1)
            ->hasGuest(1)
            ->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'is_dev' => true
        ]);

        Phone::factory()
            ->count(1)
            ->create([
                'user_id' => $user->first()->id,
                'is_default' => 1
            ]);

        Publication::factory()
            ->count(100)
            ->hasPictures(3)
            ->hasRentType(1)
            ->hasAvailableDays(rand(1, 5))
            ->create();
    }
}
