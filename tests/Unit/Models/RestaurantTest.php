<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Restaurant;

class RestaurantTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAcceptRegistrations()
    {
        Restaurant::factory()->count(5)->create();
        $count = Restaurant::get()->count();    
        $this->assertEquals(5, $count);

        $firstRecordId = Restaurant::first()->id;
        $lastRecordId = Restaurant::all()->last()->id;
        $restaurant = Restaurant::find(rand($firstRecordId, $lastRecordId));
        $restaurantName = $restaurant->name;
        $restaurantImagePath = $restaurant->image_path;
        $restaurantArea = $restaurant->area;
        $restaurantGenre = $restaurant->genre;
        $restaurantDescription = $restaurant->description;
        $this->assertDatabaseHas('restaurants',[
            'name' => $restaurantName,
            'image_path' => $restaurantImagePath,
            'area' => $restaurantArea,
            'genre' => $restaurantGenre,
            'description' => $restaurantDescription,
        ]);
        $restaurant->delete();
        $this->assertDatabaseMissing('restaurants',[
            'name' => $restaurantName,
            'image_path' => $restaurantImagePath,
            'area' => $restaurantArea,
            'genre' => $restaurantGenre,
            'description' => $restaurantDescription,
        ]);
    }

    public function testRejectRegistrations()
    {
        $validData = [
            'name' => 'name',
            'image_path' => 'localhost/img/img.jpg',
            'area' => '東京',
            'genre' => '寿司',
            'description' => 'うまい',
        ];
        $datas = [];
        array_push($datas, array_replace($validData, [
            'name' => null,
        ]));
        array_push($datas, array_replace($validData, [
            'name' => '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',
        ]));
        array_push($datas, array_replace($validData, [
            'image_path' => null,
        ]));
        array_push($datas, array_replace($validData, [
            'image_path' => '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890@example.com',
        ]));
        array_push($datas, array_replace($validData, [
            'area' => null,
        ]));
        array_push($datas, array_replace($validData, [
            'area' => '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',
        ]));
        array_push($datas, array_replace($validData, [
            'genre' => null,
        ]));
        array_push($datas, array_replace($validData, [
            'genre' => '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',
        ]));
        array_push($datas, array_replace($validData, [
            'description' => null,
        ]));
        array_push($datas, array_replace($validData, [
            'description' => '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',
        ]));
        
        $restaurant = new Restaurant();
        foreach ($datas as $data) {
                try{
                $restaurant->fill($data)->save();
            }catch(\Exception $e){
            }
            $this->assertDatabaseMissing('restaurants',$data);
        }
    }
}
