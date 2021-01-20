<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('reg_num')->unique();
            $table->string('from_location');
            $table->string('to_location');
            $table->time('start_time');
            $table->time('time_to_reach');
            $table->text('off_day')->nullable();
            $table->integer('seat_num');
            $table->integer('price');
            $table->text('description')->nullable();
            $table->string('status')->default('pending');
            $table->boolean('display')->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buses');
    }
}
