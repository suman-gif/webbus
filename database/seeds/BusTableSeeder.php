<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('buses')->insert([
            'user_id' => 2,
            'name' => 'Koshi Travels',
            'reg_num' => 'Ko 2 pa 2323',
            'from_location' => 'Dharan',
            'to_location' => 'Itahari',
            'start_time' => '14:50:00',
            'time_to_reach' => '15:05:00',
            'off_day' => 'Saturday',
            'seat_num' => 39,
            'price' => 35,
            'status' => 'approved',
            'created_at' =>NOW(),
        ]);

        DB::table('buses')->insert([
            'user_id' => 2,
            'name' => 'Facebook Travels',
            'reg_num' => 'Ko 2 pa 951',
            'from_location' => 'Dharan',
            'to_location' => 'Itahari',
            'start_time' => '9:30:00',
            'time_to_reach' => '9:55:00',
            'off_day' => 'Saturday',
            'seat_num' => 43,
            'price' => 38,
            'status' => 'approved',
            'created_at' =>NOW(),
        ]);

        DB::table('buses')->insert([
            'user_id' => 2,
            'name' => 'Google Travels',
            'reg_num' => 'Ko 2 pa 9521',
            'from_location' => 'Dharan',
            'to_location' => 'Biratnagar',
            'start_time' => '9:30:00',
            'time_to_reach' => '9:55:00',
            'off_day' => 'Saturday',
            'seat_num' => 43,
            'price' => 80,
            'status' => 'approved',
            'created_at' =>NOW(),
        ]);
    }
}
