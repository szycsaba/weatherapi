<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create([
            'name' => 'Athens',
            'lat' => '37.9534',
            'lon' => '23.7490',
        ]);

        City::create([
            'name' => 'Budapest',
            'lat' => '47.4980',
            'lon' => '19.0399',
        ]);

        City::create([
            'name' => 'Jakarta',
            'lat' => '-6.2118',
            'lon' => '106.8416',
        ]);

        City::create([
            'name' => 'Rome',
            'lat' => '41.8947',
            'lon' => '12.4811',
        ]);

        City::create([
            'name' => 'Wellington',
            'lat' => '-41.2866',
            'lon' => '174.7756',
        ]);

    }
}
