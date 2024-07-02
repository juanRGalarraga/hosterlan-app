<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Publication\RentType as PublicationRentType;
use App\Models\RentType;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Owner;
use App\Models\Publication;
use App\Models\Picture;
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
        Owner::factory()->count(30)->create();
        
        RentType::factory(count(PublicationRentType::cases()))->createMany($this->getRentTypesToFactory());

        Publication::factory()
            ->has(Picture::factory()->count(4))
        ->count(25)->create();
        
        User::factory()->count(1)->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ]);
    }

    private function getRentTypesToFactory(){
        $rentTypes = new Collection();
        foreach (PublicationRentType::cases() as $rentType) {
            $rentTypes->add(['name' => $rentType->value]);
        }
        return $rentTypes->all();
    }
}
