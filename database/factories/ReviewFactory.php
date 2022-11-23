<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Reservation;
use App\Models\Review;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $firstReservationId = Reservation::first()->id;
        $lastReservationId = Reservation::all()->last()->id;
        $reservation_id = rand($firstReservationId, $lastReservationId);
        return [
            'reservation_id' => $reservation_id,
            'score' => rand(1, 5),
            'comment' => $this->faker->realText($this->faker->numberBetween(20, 30)),
        ];
    }
}
