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
            $table->string('asigner');
            $table->integer('projectId');
            $table->string('worker');
            $table->string('planedHours');
            $table->string('actualHours');
            $table->string('billableAmount');
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
        Schema::dropIfExists('asign');
    }
}
