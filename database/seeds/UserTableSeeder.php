<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'type'      => 'admin',
            'email'     => 'rejohn@mail.com',
            'password'  => Hash::make('123456789'),
            'status'    => 1
        ]);

        DB::table('users')->insert([
            'type'      => 'executive',
            'email'     => 'executive@mail.com',
            'password'  => Hash::make('123456789')
        ]);

        DB::table('users')->insert([
            'type'      => 'customer',
            'email'     => 'customer@mail.com',
            'password'  => Hash::make('123456789'),
            'status'    => 1
        ]);
    }
}
