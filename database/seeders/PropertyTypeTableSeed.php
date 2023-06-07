<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyTypeTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::Table('property_types')->insert([
            [
                'type_name' => 'Residential',
                'type_icon' => 'icon-1'
            ],
             [
                'type_name' => 'Commercial',
                'type_icon' => 'icon-2'
             ],
             [
                'type_name' => 'Appertment',
                'type_icon' => 'icon-3'
             ],
             [
                'type_name' => 'Industrial',
                'type_icon' => 'icon-4'
             ],
             [
                'type_name' => 'Building Code',
                'type_icon' => 'icon-5'
             ],
        ]);
    }
}
