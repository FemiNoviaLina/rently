<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'name' => 'John Doe' , 
                'email' => 'johndoe@mail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now()
            ],
            [ 
                'name' => 'Jane Doe' , 
                'email' => 'janedoe@mail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now()
            ],
            [ 
                'name' => 'John Smith' ,
                'email' => 'johnsmith@mail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now()
            ]
        ];

        \DB::table('users')->insert($data);
    }
}
