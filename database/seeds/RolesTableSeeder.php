<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Role id for superadmin will be 1
        DB::table('roles')->insert([
        	'name' => 'Super Admin',
        	'slug' => 'su',
            'created_at' =>NOW()
        ]);


        //Role id for admin will be 2
        DB::table('roles')->insert([
        	'name' => 'Admin',
        	'slug' => 'admin',
            'created_at' =>NOW()
        ]);

        //Role id for customer will be 3
         DB::table('roles')->insert([
        	'name' => 'Customer',
        	'slug' => 'customer',
            'created_at' =>NOW()
        ]);
    }
}
