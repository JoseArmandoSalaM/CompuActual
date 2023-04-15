<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Jose Armando Salazar Moreno',
            'email' => 'armando@gmail.com',
            'password' => bcrypt('123456789')
        ])->assignRole('Admin');

        User::create([
            'name' => 'Marco Antonio Meza Sampedro',
            'email' => 'marcos@gmail.com',
            'password' => bcrypt('123456789')
        ])->assignRole('Admin');

        User::create([
            'name' => 'Fani Michell Izquierdo ',
            'email' => 'fani@gmail.com',
            'password' => bcrypt('123456789')
        ])->assignRole('Admin');

        User::create([
            'name' => 'Gaby Saez',
            'email' => 'gaby@gmail.com',
            'password' => bcrypt('123456789')
        ])->assignRole('Admin');


        //User::Factory(9)->create();

    }
}
