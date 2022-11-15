<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Administrator;
use Carbon\Carbon;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => 'administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
        ];
        User::create($user);
        $user_id = User::where('email', '=', $user['email'])->get()[0]->id;
        $administrator = [
            'user_id' => $user_id,
        ];
        Administrator::create($administrator);

    }
}
