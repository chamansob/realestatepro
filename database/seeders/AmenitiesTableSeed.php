<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmenitiesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::Table('amenities')->insert([
            [
                'amenities_name' => 'Air Conditioning'               
            ],
            [
                'amenities_name' => 'Central Heating'
            ],
            [
                'amenities_name' => 'Cleaning Service'
            ],
            [
                'amenities_name' => 'Dining Room'
            ],
            [
                'amenities_name' => 'Dishwasher'
            ],
            [
                'amenities_name' => 'Family Room'
            ],
            [
                'amenities_name' => 'Onsite Parking'
            ],
             [
                'amenities_name' => 'Fireplace'
            ],
             [
                'amenities_name' => 'Hardwood Flows'
            ],
        ]);
    }
}
