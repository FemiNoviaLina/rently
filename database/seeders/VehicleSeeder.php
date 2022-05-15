<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Honda Scoopy Smart Key',
                'brand' => 'Honda',
                'transmission' => 'Automatic',
                'fuel' => 'Pertamax',
                'cc' => 110,
                'price' => 105000,
                'type' => 'motor',
                'photo' => 'Honda Scoopy Smart Key.jpg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'year' => 2022,
                'available_unit' => 3
            ],
            [
                'name' => 'Honda Revo X',
                'brand' => 'Honda',
                'transmission' => 'Manual',
                'fuel' => 'Pertamax',
                'cc' => 110,
                'price' => 90000,
                'type' => 'motor',
                'photo' => 'Honda Revo X.jpg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'year' => 2019,
                'available_unit' => 2
            ],
            [
                'name' => 'Honda BeAT FI',
                'brand' => 'Honda',
                'transmission' => 'Automatic',
                'fuel' => 'Pertamax',
                'cc' => 110,
                'price' => 85000,
                'type' => 'motor',
                'photo' => 'Honda BeAT FI.jpg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'year' => 2019,
                'available_unit' => 3
            ]
        ];

        \DB::table('vehicles')->insert($data);
    }
}
