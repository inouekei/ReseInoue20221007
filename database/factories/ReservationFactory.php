<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\Restaurant;
use Carbon\Carbon;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $firstCustomerId = Customer::first()->id;
        $lastCustomerId = Customer::all()->last()->id;
        $firstRestaurantId = Restaurant::first()->id;
        $lastRestaurantId = Restaurant::all()->last()->id;
        $customer_id = rand($firstCustomerId, $lastCustomerId);
        $restaurant_id = rand($firstRestaurantId, $lastRestaurantId);
        return [
            'customer_id' => $customer_id,
            'restaurant_id' => $restaurant_id,
            'reservation_datetime' => Carbon::now(),
            'num_of_seats' => rand(1, 255),
        ];
    }
}
