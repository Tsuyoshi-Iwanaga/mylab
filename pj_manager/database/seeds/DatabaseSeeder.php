<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(BranchTableSeeder::class);
        $this->call(GradeTableSeeder::class);
        $this->call(GroupTableSeeder::class);
        $this->call(PeriodTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(AsignTableSeeder::class);
    }
}
