<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Restaurant;

class RestaurantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $genreId = $this->faker->numberBetween(0, 4);

        return [
            'name' => $this->faker->word,
            'image_path' => config('const.DUMMY_IMAGES_PATH') . config('const.GENRE_IMAGE_NAMES')[$genreId] . '.jpg',
            'area' => $this->faker->randomElement(config('const.AREAS')),
            'genre' => config('const.GENRES')[$genreId],
            'description' => $this->faker->realText($this->faker->numberBetween(20, 30)),
        ];
    }
}
