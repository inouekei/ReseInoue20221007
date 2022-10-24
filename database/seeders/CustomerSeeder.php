<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Customer;

class CustomerSeeder extends Seeder
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
                'name' => 'customer' . $i,
                'email' => 'customer' . $i . '@example.com',
                'password' => Hash::make('password'),
            ];
            User::create($user);
            $user_id = User::where('email', '=', $user['email'])->get()[0]->id;

            $customer = [
                'user_id' => $user_id,
            ];
            Customer::create($customer);
        }
    }
}
