<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Admin',
            'email' => 'fukuoka@test.com',
            'password' => Hash::make('fukuoka2020'),
            'remember_token' => str_random(10),
        ]);
    }
}
