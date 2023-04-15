<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);

        $this->call(UserSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Trabajadore::factory()->create([
            'direccion' => 'Puebla',
            'telefono' => '5532489563',
            'user_id' => 1,
        ]);
        \App\Models\Trabajadore::factory()->create([
            'direccion' => 'Tlaxcala',
            'telefono' => '5532489563',
            'user_id' => 2,
        ]);

        \App\Models\Cliente::factory()->create([
            'direccion' => 'Puebla',
            'telefono' => '5532489563',
            'user_id' => 3,
        ]);

        
        \App\Models\Cliente::factory()->create([
            'direccion' => 'Puebla',
            'telefono' => '5532489563',
            'user_id' => 4,
        ]);

        $etapas = ['Recepción', 'Diagnóstico','Autorización','Reparación','Entrega'];
        $porcentaje = [0, 25,50,75,100];
        /*
        for ($i=0; $i < count($etapas); $i++) { 
           \App\Models\etapas::factory()->create([
               'Nombre' => $etapas[$i],
               'Porcentaje' => $porcentaje[$i]
            ]);

            INSERT INTO `etapas`(`Nombre`, `Porcentaje`) VALUES ('Recepción','0'),
('Diagnóstico','25'),
('Autorización','50'),
('Reparación','75'),
('Entrega','100');
        }*/
    }
}
