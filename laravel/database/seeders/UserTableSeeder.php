<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user01 = [
            'name' => 'tsuyoshi',
            'email' => 'tsuyo.1991@gmail.com',
            'password' => 'hogehoge',
        ];
        DB::table('users')->insert($user01);
    }
}
