<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'user_1',
            'email'=> 'user1@test.com',
            'password' => Hash::make('user1')
        ]);

        User::create([
            'name' => 'user_2',
            'email'=> 'user2@test.com',
            'password' => Hash::make('user2')
        ]);
    }
}
