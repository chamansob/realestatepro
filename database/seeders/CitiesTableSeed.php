<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::Table('cities')->insert([
            [
                'name' => 'Yemen',
                'state_id' => 12,
                'status' => 1
            ]
        ]);
    }
}
