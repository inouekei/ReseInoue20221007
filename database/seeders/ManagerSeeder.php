<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Manager;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userLastId = User::all()->last()->id ?? 0; 
        for ($i = $userLastId + 1; $i < $userLastId + 5; $i++){
            $user = [
                'name' => 'manager' . $i,
                'email' => 'manager' . $i . '@example.com',
                'password' => Hash::make('password'),
            ];
            User::create($user);
            $user_id = User::where('email', '=', $user['email'])->get()[0]->id;

            $manager = [
                'user_id' => $user_id,
            ];
            Manager::create($manager);
        }
    }
}
