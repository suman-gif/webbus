<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusBookedSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_booked_seats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bus_id');
            $table->text('booked_seats_id');
            $table->text('booked_seats_num');
            $table->date('booked_date');
            $table->timestamps();

            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bus_booked_seats');
    }
}
