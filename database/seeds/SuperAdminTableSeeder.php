<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuperAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'role_id' => 1,
        	'name' => 'Super Admin',
        	'username' => 'superadmin',
        	'email' => 'superadmin@webbus.com',
        	'password' => bcrypt('admin'),
            'address' => 'Dharan-8',
            'city' => 'Dharan',
        	'phone' => 9810570523,
        	'district' => 'Sunsari',
            'created_at' =>NOW()
        ]);

        DB::table('users')->insert([
            'role_id' => 2,
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@webbus.com',
            'password' => bcrypt('admin'),
            'address' => 'Dharan-8',
            'city' => 'Dharan',
            'phone' => 9810570523,
            'district' => 'Sunsari',
            'created_at' =>NOW()
        ]);

     
    }
}
