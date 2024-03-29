<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacationTable extends Migration
{
    public function up()
    {
        Schema::create('vacations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('days_taken');
            $table->string('reason');
            $table->string('observations');
            $table->string('type');
            $table->date('date_init');
            $table->date('date_end')->nullable();
            $table->integer('worker_id')->unsigned();
            $table->foreign('worker_id')->references('id')->on('workers');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('vacations');
    }
}
