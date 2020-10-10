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
            'projectCode' => 'FKU-CO-001',
            'jobCode' => '1234567890',
            'name' => 'キャンペーンLP作成',
            'client' => 1,
            'director' => '田中 太郎',
            'assigner' => '森永 秀太',
        ]);
        App\Project::create([
            'projectCode' => 'FKU-CO-002',
            'jobCode' => '1000000001',
            'name' => 'レスポンシブメルマガ制作',
            'client' => 2,
            'director' => '田中 太郎',
            'assigner' => '森永 秀太',
        ]);
        App\Project::create([
            'projectCode' => 'FKU-CO-003',
            'jobCode' => '1111111111',
            'name' => '告知バナー制作',
            'client' => 3,
            'director' => '田中 太郎',
            'assigner' => '森永 秀太',
        ]);
    }
}
