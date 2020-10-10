<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Client::create([
            'name' => '株式会社AAA',
        ]);
        App\Client::create([
            'name' => 'BBBコーポレーション',
        ]);
        App\Client::create([
            'name' => 'CCCホールディングス株式会社',
        ]);
    }
}
