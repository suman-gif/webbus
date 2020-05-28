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
        	'password' => bcrypt('admin1'),
        	'phone' => 9810570523,
        	'district' => 'Sunsari',
            'created_at' =>NOW()
        ]);

     
    }
}
