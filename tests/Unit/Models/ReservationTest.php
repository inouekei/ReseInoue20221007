<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Reservation;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Customer;
use App\Models\Restaurant;

class ReservationTest extends TestCase
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
        Reservation::factory()->count(5)->create();
        $count = Reservation::get()->count();    
        $this->assertEquals(5, $count);

        $firstRecordId = Reservation::first()->id;
        $lastRecordId = Reservation::all()->last()->id;
        $reservation = Reservation::find(rand($firstRecordId, $lastRecordId));
        $reservationCustomer = $reservation->customer_id;
        $reservationRestaurant = $reservation->restaurant_id;
        $reservationDate = $reservation->reservation_datetime;
        $reservationSeats = $reservation->num_of_seats;
        $this->assertDatabaseHas('reservations',[
            'customer_id' => $reservationCustomer,
            'restaurant_id' => $reservationRestaurant,
            'reservation_datetime' => $reservationDate,
            'num_of_seats' => $reservationSeats,
        ]);
        $reservation->delete();
        $this->assertDatabaseMissing('reservations',[
            'customer_id' => $reservationCustomer,
            'restaurant_id' => $reservationRestaurant,
            'reservation_datetime' => $reservationDate,
            'num_of_seats' => $reservationSeats,
        ]);
    }

    public function testRejectRegistrations()
    {
        for ($i = 0; $i < 5; $i++){
            User::factory()->create();
            Customer::factory()->create();
        }
        Restaurant::factory()->count(5)->create();

        $firstCustomerId = Customer::first()->id;
        $lastCustomerId = Customer::all()->last()->id;
        $firstRestaurantId = Restaurant::first()->id;
        $lastRestaurantId = Restaurant::all()->last()->id;
        $customer_id = rand($firstCustomerId, $lastCustomerId);
        $restaurant_id = rand($firstRestaurantId, $lastRestaurantId);

        $validData = [
            'customer_id' => $customer_id,
            'restaurant_id' => $restaurant_id,
            'reservation_datetime' => Carbon::now(),
            'num_of_seats' => 5,
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
        array_push($datas, array_replace($validData, [
            'reservation_datetime' => null,
        ]));
        array_push($datas, array_replace($validData, [
            'reservation_datetime' => 'abc',
        ]));
        array_push($datas, array_replace($validData, [
            'num_of_seats' => null,
        ]));
        array_push($datas, array_replace($validData, [
            'num_of_seats' => 'abc',
        ]));
        array_push($datas, array_replace($validData, [
            'num_of_seats' => -1,
        ]));
        array_push($datas, array_replace($validData, [
            'num_of_seats' => 2.5,
        ]));
        array_push($datas, array_replace($validData, [
            'num_of_seats' => 256,
        ]));
        
        $reservation = new Reservation();
        foreach ($datas as $data) {
                try{
                $reservation->fill($data)->save();
            }catch(\Exception $e){
            }
            $this->assertDatabaseMissing('reservations',$data);
        }
    }
}
