<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\Restaurant;
use App\Models\Favorite;

class FavoriteFactory extends Factory
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
        do {
            $customer_id = rand($firstCustomerId, $lastCustomerId);
            $restaurant_id = rand($firstRestaurantId, $lastRestaurantId);
        } while (Favorite::where('customer_id', $customer_id)
        ->where('restaurant_id', $restaurant_id)
        ->get()->count());

        return [
            'customer_id' => $customer_id,
            'restaurant_id' => $restaurant_id,
        ];
    }
}
