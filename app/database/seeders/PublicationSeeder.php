<?php

namespace Database\Seeders;

use App\Models\Publication;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Publication::factory()
            ->count(10)
            ->hasPictures(5)
            ->hasRentType(1)
            ->hasAvailableDays(rand(1, 5))
            ->create();
    }
}
