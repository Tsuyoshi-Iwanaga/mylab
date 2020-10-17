<?php

use Illuminate\Database\Seeder;

class PeriodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Group::create(['name' => '確認中']);
        App\Group::create(['name' => '2020-03']);
        App\Group::create(['name' => '2020-04']);
        App\Group::create(['name' => '2020-05']);
        App\Group::create(['name' => '2020-06']);
        App\Group::create(['name' => '2020-07']);
        App\Group::create(['name' => '2020-08']);
        App\Group::create(['name' => '2020-09']);
        App\Group::create(['name' => '2020-10']);
        App\Group::create(['name' => '2020-11']);
        App\Group::create(['name' => '2020-12']);
        App\Group::create(['name' => '2021-01']);
        App\Group::create(['name' => '2021-02']);
        App\Group::create(['name' => '2021-03']);
    }
}
