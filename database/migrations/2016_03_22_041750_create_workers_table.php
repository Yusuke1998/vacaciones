<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkersTable extends Migration
{
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('ci')->unique();
            $table->string('cellphone');
            $table->string('photo');
            $table->date('date_in');
            $table->date('date_out');
            $table->string('position');
            $table->integer('days_taken_rest')->nullable();
            $table->string('email')->unique();
            $table->smallInteger('state')->default('0');
            $table->text('reason_retirement')->nullable();
            $table->timestamps();
            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('areas');
        });
    }

    public function down()
    {
        Schema::drop('workers');
    }
}
