<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Manager;

class ManagerTest extends TestCase
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
            Manager::factory()->create();
        }
        $count = Manager::get()->count();    
        $this->assertEquals(5, $count);

        $firstRecordId = Manager::first()->id;
        $lastRecordId = Manager::all()->last()->id;
        $manager = Manager::find(rand($firstRecordId, $lastRecordId));
        $managerUserId = $manager->user_id;
        $this->assertDatabaseHas('managers',[
            'user_id' => $managerUserId,
        ]);
        $manager->delete();
        $this->assertDatabaseMissing('managers',[
            'user_id' => $managerUserId,
        ]);
    }

    public function testRejectRegistrations()
    {
        for ($i = 0; $i < 5; $i++){
            User::factory()->create();
            Manager::factory()->create();
        }
        $firstRecordId = Manager::first()->id;
        $lastRecordId = Manager::all()->last()->id;
        $datas = [];
        array_push($datas, [
            'user_id' => null,
        ]);
        array_push($datas, [
            'user_id' => $lastRecordId + 1,
        ]);
        
        $manager = new Manager();
        foreach ($datas as $data) {
            try {
                $manager->fill($data)->save();
            } catch (\Exception $e) {
            }
            $this->assertDatabaseMissing('managers',$data);
        }

        $randUserId = Manager::find(rand($firstRecordId, $lastRecordId))->user_id;
        try {
            $manager->fill(['user_id' => $randUserId])->save();
        } catch (\Exception $e) {
        }
        $this->assertEquals(1, Manager::where('user_id', $randUserId)->get()->count());
    }
}
