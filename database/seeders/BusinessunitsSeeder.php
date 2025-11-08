<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class BusinessunitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('businessunits')->insert([
            'organization_name' => 'Forge Alumnus',
            'organization_started_on' => '',
            'primary_phone_number' => '',
            'secondary_phone_number' => '',
            'fax_number' => '',
            'country' => '',
            'state' => '',
            'city' => '',
            'currency' => '',
            'address' => '',
            'org_logo' => '',
            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' =>  date('Y-m-d H:i:s')
        ]);
    }
}
