<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Customer;
use App\Models\Restaurant;
use App\Models\Favorite;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAcceptRegistrations()
    {
        for ($i = 0; $i < 5; $i++){
            User::factory()->create();
            Customer::factory()->create();
        }
        Restaurant::factory()->count(5)->create();
        Favorite::factory()->count(5)->create();
        $count = Favorite::get()->count();    
        $this->assertEquals(5, $count);

        $firstRecordId = Favorite::first()->id;
        $lastRecordId = Favorite::all()->last()->id;
        $favorite = Favorite::find(rand($firstRecordId, $lastRecordId));
        $favoriteCustomer = $favorite->customer_id;
        $favoriteRestaurant = $favorite->restaurant_id;
        $this->assertDatabaseHas('favorites',[
            'customer_id' => $favoriteCustomer,
            'restaurant_id' => $favoriteRestaurant,
        ]);
        $favorite->delete();
        $this->assertDatabaseMissing('favorites',[
            'customer_id' => $favoriteCustomer,
            'restaurant_id' => $favoriteRestaurant,
        ]);
    }

    public function testRejectRegistrations()
    {
        for ($i = 0; $i < 5; $i++){
            User::factory()->create();
            Customer::factory()->create();
        }
        Restaurant::factory()->count(5)->create();
        Favorite::factory()->count(5)->create();

        $firstCustomerId = Customer::first()->id;
        $lastCustomerId = Customer::all()->last()->id;
        $firstRestaurantId = Restaurant::first()->id;
        $lastRestaurantId = Restaurant::all()->last()->id;
        $customer_id = rand($firstCustomerId, $lastCustomerId);
        $restaurant_id = rand($firstRestaurantId, $lastRestaurantId);

        $validData = [
            'customer_id' => $customer_id,
            'restaurant_id' => $restaurant_id,
        ];
        $datas = [];
        array_push($datas, array_replace($validData, [
            'customer_id' => null,
        ]));
        array_push($datas, array_replace($validData, [
            'customer_id' => $lastCustomerId + 1,
        ]));
        array_push($datas, array_replace($validData, [
            'restaurant_id' => null,
        ]));
        array_push($datas, array_replace($validData, [
            'restaurant_id' => $lastRestaurantId + 1,
        ]));
        
        $favorite = new Favorite();
        foreach ($datas as $data) {
                try{
                $favorite->fill($data)->save();
            } catch (\Exception $e) {
            }
            $this->assertDatabaseMissing('favorites',$data);
        }

        $firstRecordId = Favorite::first()->id;
        $lastRecordId = Favorite::all()->last()->id;
        $randFavorite = Favorite::find(rand($firstRecordId, $lastRecordId));
        try {
            $customer->fill([
                'customer_id' => $randFavorite->customer_id,
                'restaurant_id' => $randFavorite->restaurant_id
                ])->save();
        } catch (\Exception $e) {
        }
        $this->assertEquals(1, Favorite::where('customer_id', $randFavorite->customer_id)
            ->where('restaurant_id', $randFavorite->restaurant_id)->get()->count());
    }
}
