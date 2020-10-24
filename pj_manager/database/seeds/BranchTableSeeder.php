<?php

use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Branch::create([
            'name' => 'その他'
        ]);
        App\Branch::create([
            'name' => 'MC1部2課'
        ]);
        App\Branch::create([
            'name' => 'MC1部3課'
        ]);
        App\Branch::create([
            'name' => 'MC2部4課'
        ]);
    }
}
