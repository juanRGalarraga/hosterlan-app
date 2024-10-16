<?php

namespace Database\Factories;

use App\Models\Picture;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Picture>
 */
class PictureFactory extends Factory
{
    private static int $pictureIndex = 0;

    private static array $pictures = [];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        self::$pictures = $this->pictures();
        $picture = self::$pictures[self::$pictureIndex];

        // Incrementar el índice y reiniciarlo si es necesario
        self::$pictureIndex = (self::$pictureIndex + 1) % count(self::$pictures);

        return [
            'name' => $picture,
            'type' => pathinfo($picture, PATHINFO_EXTENSION),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Picture $picture) {
            Storage::copy("stock/$picture->name", "public/publication-pictures/{$picture->publication->id}/{$picture->name}");
        });
    }

    public function pictures(): array
    {
        $files = Storage::allFiles('stock');
        if($files){
            $files = array_map(fn($file) => basename($file), $files);
        }
        return $files;

    }
}