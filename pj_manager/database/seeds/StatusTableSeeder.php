<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Status::create(['name' => '-']);
        App\Status::create(['name' => '進行中']);
        App\Status::create(['name' => '完了']);
        App\Status::create(['name' => '消滅']);
        App\Status::create(['name' => '辞退']);
        App\Status::create(['name' => 'ペンディング']);
    }
}
