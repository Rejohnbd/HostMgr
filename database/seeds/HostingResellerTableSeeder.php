<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HostingResellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hosting_resellers')->insert([
            'name'      => 'HostGator',
            'email'     => 'hostgator@mail.com',
            'website'   => 'https://hostgator.com',
            'details'   => 'NameCheape Domain Reseller'
        ]);

        DB::table('hosting_resellers')->insert([
            'name'      => 'Godaddy',
            'email'     => 'godaddy@mail.com',
            'website'   => 'https://godaddy.com',
            'details'   => 'Godaddy Domain Reseller'
        ]);
    }
}
