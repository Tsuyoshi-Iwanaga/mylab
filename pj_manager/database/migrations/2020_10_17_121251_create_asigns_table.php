<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('project_id');
            $table->boolean('is_manhours_defined');
            $table->integer('worker_id');
            $table->integer('office_id');
            $table->integer('billing_id');
            $table->integer('grade_id');
            $table->string('planed_hours');
            $table->string('actual_hours');
            $table->integer('billable_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asigns');
    }
}
