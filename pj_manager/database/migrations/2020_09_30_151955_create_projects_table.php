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
            $table->integer('jobCode')->nullable();;
            $table->string('name');
            $table->integer('period_id');
            $table->integer('group_id');
            $table->integer('client_id');
            $table->integer('branch_id');
            $table->integer('status_id');
            $table->string('director')->nullable();
            $table->string('director_email')->nullable();;
            $table->string('assigner');
            $table->text('note');
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
