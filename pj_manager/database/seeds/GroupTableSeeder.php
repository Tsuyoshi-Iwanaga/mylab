<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Group::create([
            'name' => 'REG'
        ]);
        App\Group::create([
            'name' => 'CO1'
        ]);
        App\Group::create([
            'name' => 'CO2'
        ]);
        App\Group::create([
            'name' => 'CO3'
        ]);
        App\Group::create([
            'name' => 'NIL'
        ]);
        App\Group::create([
            'name' => 'NIS'
        ]);
        App\Group::create([
            'name' => 'LAW'
        ]);
        App\Group::create([
            'name' => 'STB'
        ]);
    }
}
