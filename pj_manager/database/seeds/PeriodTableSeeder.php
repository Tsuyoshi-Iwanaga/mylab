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
        App\Period::create(['name' => '確認中']);
        App\Period::create(['name' => '2020-03']);
        App\Period::create(['name' => '2020-04']);
        App\Period::create(['name' => '2020-05']);
        App\Period::create(['name' => '2020-06']);
        App\Period::create(['name' => '2020-07']);
        App\Period::create(['name' => '2020-08']);
        App\Period::create(['name' => '2020-09']);
        App\Period::create(['name' => '2020-10']);
        App\Period::create(['name' => '2020-11']);
        App\Period::create(['name' => '2020-12']);
        App\Period::create(['name' => '2021-01']);
        App\Period::create(['name' => '2021-02']);
        App\Period::create(['name' => '2021-03']);
    }
}
