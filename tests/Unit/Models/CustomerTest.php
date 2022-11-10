<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Customer;

class CustomerTest extends TestCase
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
        $count = Customer::get()->count();    
        $this->assertEquals(5, $count);

        $firstRecordId = Customer::first()->id;
        $lastRecordId = Customer::all()->last()->id;
        $customer = Customer::find(rand($firstRecordId, $lastRecordId));
        $customerUserId = $customer->user_id;
        $this->assertDatabaseHas('customers',[
            'user_id' => $customerUserId,
        ]);
        $customer->delete();
        $this->assertDatabaseMissing('customers',[
            'user_id' => $customerUserId,
        ]);
    }

    public function testRejectRegistrations()
    {
        for ($i = 0; $i < 5; $i++){
            User::factory()->create();
            Customer::factory()->create();
        }
        $firstRecordId = Customer::first()->id;
        $lastRecordId = Customer::all()->last()->id;
        $datas = [];
        array_push($datas, [
            'user_id' => null,
        ]);
        array_push($datas, [
            'user_id' => $lastRecordId + 1,
        ]);
        
        $customer = new Customer();
        foreach ($datas as $data) {
            try {
                $customer->fill($data)->save();
            } catch (\Exception $e) {
            }
            $this->assertDatabaseMissing('customers',$data);
        }

        $randUserId = Customer::find(rand($firstRecordId, $lastRecordId))->user_id;
        try {
            $customer->fill(['user_id' => $randUserId])->save();
        } catch (\Exception $e) {
        }
        $this->assertEquals(1, Customer::where('user_id', $randUserId)->get()->count());
    }
}
