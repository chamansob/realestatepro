<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagePresetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::Table('image_presets')->insert([
            [
                'name' => 'small',
                'width' => 36,
                'height' => 36
            ],
            [
                'name' => 'avatar',
                'width' => 30,
                'height' => 30
            ],
            [
                'name' => 'thumb',
                'width' => 138,
                'height' => 93
             ],
        ]);
    }
}
