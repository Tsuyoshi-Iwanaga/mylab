<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function(BluePrint $table) {
            $table->increments('id');
            $table->string('projectCode')->unique();
            $table->integer('jobCode')->nullable();;
            $table->string('name');
            $table->string('client');
            $table->string('director')->nullable();;
            $table->string('assigner');
            $table->string('worker')->nullable();;
            $table->integer('amount')->nullable();;
            $table->datetime('estimatedTime')->nullable();;
            $table->datetime('actualTime')->nullable();;
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
        Schema::dropIfExists('projects');
    }
}
