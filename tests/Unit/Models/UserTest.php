<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAcceptRegistrations()
    {
        User::factory()->count(5)->create();
        $count = User::get()->count();    
        $this->assertEquals(5, $count);

        $firstRecordId = User::first()->id;
        $lastRecordId = User::all()->last()->id;
        $user = User::find(rand($firstRecordId, $lastRecordId));
        $userName = $user->name;
        $userEmail = $user->email;
        $userPassword = $user->password;
        $this->assertDatabaseHas('users',[
            'name' => $userName,
            'email' => $userEmail,
            'password' => $userPassword,
        ]);
        $user->delete();
        $this->assertDatabaseMissing('users',[
            'name' => $userName,
            'email' => $userEmail,
            'password' => $userPassword,
        ]);
    }

    public function testRejectRegistrations()
    {
        $validData = [
	        'name' => 'testuser',
	        'email' => 'test@example.com',
	        'password' => 'password',
        ];
        $datas = [];
        array_push($datas, array_replace($validData, [
            'name' => null,
        ]));
        array_push($datas, array_replace($validData, [
            'name' => '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',
        ]));
        array_push($datas, array_replace($validData, [
            'email' => null,
        ]));
        array_push($datas, array_replace($validData, [
            'email' => '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890@example.com',
        ]));
        array_push($datas, array_replace($validData, [
            'password' => null,
        ]));
        array_push($datas, array_replace($validData, [
            'password' => '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',
        ]));
        
        $user = new User();
        foreach ($datas as $data) {
                try{
                $user->fill($data)->save();
            }catch(\Exception $e){
            }
            $this->assertDatabaseMissing('users',$data);
        }
    }
}
