<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Manager;
use App\Models\Restaurant;

class ManagerRestaurantTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAcceptRegistrations()
    {
        for ($i = 0; $i < 5; $i++){
            User::factory()->create();
            Manager::factory()->create();
        }
        Restaurant::factory()->count(5)->create();

        $firstRestaurantId = Restaurant::first()->id;
        $lastRestaurantId = Restaurant::all()->last()->id;
        $firstManagerId = Manager::first()->id;
        $lastManagerId = Manager::all()->last()->id;

        for ($i = 0; $i < 5; $i++){
            $restaurant = Restaurant::find(rand($firstRestaurantId, $lastRestaurantId));
            $manager = Manager::find(rand($firstManagerId, $lastManagerId));
            $restaurant->managers()->attach($manager->id);   
        }

        $relations = \DB::table('manager_restaurant')->get();
        $this->assertEquals(5, $relations->count());

        $firstRecordId = \DB::table('manager_restaurant')->first()->id;
        $lastRecordId = \DB::table('manager_restaurant')->latest()->first()->id;
        do {
            $relation = \DB::table('manager_restaurant')->where('id', rand($firstRecordId, $lastRecordId));
        }
        while ($relation === null);
        
        $randRestaurantId = $relation->first()->restaurant_id;
        $randManagerId = $relation->first()->manager_id;

        $this->assertDatabaseHas('manager_restaurant',[
            'restaurant_id' => $randRestaurantId,
            'manager_id' => $randManagerId,
        ]);
        $relation->delete();
        $this->assertDatabaseMissing('manager_restaurant',[
            'restaurant_id' => $randRestaurantId,
            'manager_id' => $randManagerId,
        ]);
    }

    public function testRejectRegistrations()
    {
        for ($i = 0; $i < 5; $i++){
            User::factory()->create();
            Manager::factory()->create();
        }
        Restaurant::factory()->count(5)->create();

        $firstRestaurantId = Restaurant::first()->id;
        $lastRestaurantId = Restaurant::all()->last()->id;
        $firstManagerId = Manager::first()->id;
        $lastManagerId = Manager::all()->last()->id;

        $restaurant = Restaurant::find(rand($firstRestaurantId, $lastRestaurantId));
        $datas = [];
        array_push($datas, null);
        array_push($datas, -1);
        array_push($datas, $firstManagerId - 1);
        array_push($datas, $lastManagerId + 1);
        array_push($datas, 300);
        array_push($datas, "abc");

        foreach ($datas as $data) {
            try{
            $restaurant->managers()->attach($data);   
            }catch(\Exception $e){
            }
            $this->assertDatabaseMissing('manager_restaurant', [
                'restaurant_id' => $restaurant->id, 
                'manager_id' => $data,
            ]);
        }
    }
}
