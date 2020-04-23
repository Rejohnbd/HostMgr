<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DomainResellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('domain_resellers')->insert([
            'name'      => 'NameCheape',
            'email'     => 'namecheape@mail.com',
            'website'   => 'https://namecheape.com',
            'details'   => 'NameCheape Domain Reseller'
        ]);

        DB::table('domain_resellers')->insert([
            'name'      => 'Godaddy',
            'email'     => 'godaddy@mail.com',
            'website'   => 'https://godaddy.com',
            'details'   => 'Godaddy Domain Reseller'
        ]);
    }
}
