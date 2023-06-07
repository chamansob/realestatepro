<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::Table('countries')->insert([
            [
                'name' => 'Arab',
                'status' => 1
            ]
        ]);

    }
}
