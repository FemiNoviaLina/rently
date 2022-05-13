<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name' => 'Honda' ],
            [ 'name' => 'Suzuki' ],
            [ 'name' => 'Toyota' ],
            [ 'name' => 'Yamaha' ],
            [ 'name' => 'Daihatsu' ],
            [ 'name' => 'Nissan' ]
        ];

        \DB::table('brands')->insert($data);
    }
}
