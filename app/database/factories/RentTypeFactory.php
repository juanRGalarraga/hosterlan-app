<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\Publication\RentTypeEnum;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RentType>
 */
class RentTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $rentTypes = null;

        if($rentTypes === null){
            $rentTypes = RentTypeEnum::cases();
        }

        $rentType = array_shift($rentType);

        return [
            'name' => $rentType->value,
            'description' => ''
        ];
    }
}
