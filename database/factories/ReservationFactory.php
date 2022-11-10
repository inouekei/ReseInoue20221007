<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        $customer_id = Customer::find(rand($firstCustomerId, $lastCustomerId));
        $restaurant_id = Restaurant::find(rand($firstRestaurantId, $lastRestaurantId));
        return [
            'customer_id' => $reservation_id,
            'restaurant_id' => $restaurant_id,
        ];
    }
}
