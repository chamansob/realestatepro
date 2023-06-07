<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::Table('states')->insert([
            [
                'name' => 'Egypt',
                'country_id' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Sudan',
                'country_id' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Algeria',
                'country_id' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Iraq',
                'country_id' => 1,
                'status' => 1,
            ], [
                'name' => 'Morocco',
                'country_id' => 1,
                'status' => 1,
            ], [
                'name' => 'Saudi Arabia',
                'country_id' => 1,
                'status' => 1,
            ], 
            [
                'name' => 'Yemen',
                'country_id' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Syria',
                'country_id' => 1,
                'status' => 1,
            ], 
            [
                'name' => 'Somalia',
                'country_id' => 1,
                'status' => 1,
            ], 
            [
                'name' => 'Tunisia',
                'country_id' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Jordan',
                'country_id' => 1,
                'status' => 1,
            ],[
                'name' => 'United Arab Emirates',
                'country_id' => 1,
                'status' => 1,
            ],[
                'name' => 'Libya',
                'country_id' => 1,
                'status' => 1,
            ],[
                'name' => 'Palestine',
                'country_id' => 1,
                'status' => 1,
            ],[
                'name' => 'Lebanon',
                'country_id' => 1,
                'status' => 1,
            ],[
                'name' => 'Mauritania',
                'country_id' => 1,
                'status' => 1,
            ],[
                'name' => 'Oman',
                'country_id' => 1,
                'status' => 1,
            ],[
                'name' => 'Kuwait',
                'country_id' => 1,
                'status' => 1,
            ],[
                'name' => 'Qatar',
                'country_id' => 1,
                'status' => 1,
            ],[
                'name' => 'Bahrain',
                'country_id' => 1,
                'status' => 1,
            ],[
                'name' => 'Djibouti',
                'country_id' => 1,
                'status' => 1,
            ],[
                'name' => 'Comoros',
                'country_id' => 1,
                'status' => 1,
            ]
        ]);
    }
}
