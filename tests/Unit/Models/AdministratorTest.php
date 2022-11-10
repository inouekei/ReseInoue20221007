<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Administrator;

class AdministratorTest extends TestCase
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
            Administrator::factory()->create();
        }
        $count = Administrator::get()->count();    
        $this->assertEquals(5, $count);

        $firstRecordId = Administrator::first()->id;
        $lastRecordId = Administrator::all()->last()->id;
        $administrator = Administrator::find(rand($firstRecordId, $lastRecordId));
        $administratorUserId = $administrator->user_id;
        $this->assertDatabaseHas('administrators',[
            'user_id' => $administratorUserId,
        ]);
        $administrator->delete();
        $this->assertDatabaseMissing('administrators',[
            'user_id' => $administratorUserId,
        ]);
    }

    public function testRejectRegistrations()
    {
        for ($i = 0; $i < 5; $i++){
            User::factory()->create();
            Administrator::factory()->create();
        }
        $firstRecordId = Administrator::first()->id;
        $lastRecordId = Administrator::all()->last()->id;
        $datas = [];
        array_push($datas, [
            'user_id' => null,
        ]);
        array_push($datas, [
            'user_id' => $lastRecordId + 1,
        ]);
        
        $administrator = new Administrator();
        foreach ($datas as $data) {
            try {
                $administrator->fill($data)->save();
            } catch (\Exception $e) {
            }
            $this->assertDatabaseMissing('administrators',$data);
        }

        $randUserId = Administrator::find(rand($firstRecordId, $lastRecordId))->user_id;
        try {
            $administrator->fill(['user_id' => $randUserId])->save();
        } catch (\Exception $e) {
        }
        $this->assertEquals(1, Administrator::where('user_id', $randUserId)->get()->count());
    }
}
