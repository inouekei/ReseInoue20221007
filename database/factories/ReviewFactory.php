<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Reservation;

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
        do {
            $reservation_id = rand($firstReservationId, $lastReservationId);
        } while (Reservation::find($reservation_id)->review()->count() <> 0);
        return [
            'reservation_id' => $reservation_id,
            'score' => rand(1, 5),
            'comment' => $this->faker->realText($this->faker->numberBetween(20, 30)),
        ];
    }
}
