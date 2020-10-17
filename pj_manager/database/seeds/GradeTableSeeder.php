<?php

use Illuminate\Database\Seeder;

class GradeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Grade::create([
            'name' => 'Co-Lv1',
            'unit_price' => 250000,
        ]);
        App\Grade::create([
            'name' => 'Co-Lv2',
            'unit_price' => 300000,
        ]);
        App\Grade::create([
            'name' => 'Co-Lv3',
            'unit_price' => 350000,
        ]);
        App\Grade::create([
            'name' => 'Co-Lv4',
            'unit_price' => 400000,
        ]);
        App\Grade::create([
            'name' => 'Co-Lv5',
            'unit_price' => 450000,
        ]);
    }
}
