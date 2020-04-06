<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert([
            'name' => "Shipan Mazumder",
            'email' =>'admin@gmail.com',
            'role_id' =>1,
            'password' => Hash::make('1234'),
        ]);
         DB::table('users')->insert([
            'name' => "Joy Mazumder",
            'email' =>'moderator@gmail.com',
            'role_id' =>2,
            'password' => Hash::make('1234'),
        ]);
         DB::table('users')->insert([
            'name' => "Jon Doe",
            'email' =>'user@gmail.com',
            'role_id' =>3,
            'password' => Hash::make('1234'),
        ]);
    }
}
