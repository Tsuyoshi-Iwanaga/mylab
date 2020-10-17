<?php

use Illuminate\Database\Seeder;

class AsignTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Asign::create([
            'project_id' => 1,
            'is_manhours_defined' => true,
            'worker_id' => 1,
            'office_id' => 1,
            'billing_id' => 1,
            'grade_id' => 1,
            'planed_hours' => '8:00',
            'actual_hours' => '5:00',
            'billable_amount' => 50000,
        ]);
    }
}
