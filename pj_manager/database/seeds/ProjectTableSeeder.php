<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Project::create([
            'jobCode' => '1234567890',
            'name' => 'キャンペーンLP作成',
            'period_id' => 1,
            'group_id' => 1,
            'client_id' => 2,
            'branch_id' => 1,
            'status_id' => 1,
            'director' => '田中 太郎',
            'director_email' => 'tanaka001@test.com',
            'assigner' => '森永 秀太',
            'note' => '福岡アサイン希望',
        ]);
    }
}
