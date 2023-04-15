<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role1 = Role::create(['name' => 'Admin']);
      $role2 = Role::create(['name' => 'Tecnico']);

      Permission::create(['name' => 'tecnico.proyectos.index'])->assignRole($role1);
      Permission::create(['name' => 'tecnico.proyectos.create'])->assignRole($role1);;
      Permission::create(['name' => 'tecnico.proyectos.edit'])->assignRole($role1);
      Permission::create(['name' => 'tecnico.proyectos.destroy'])->assignRole($role1);

      Permission::create(['name' => 'tecnico.equipos.index'])->syncRoles([$role1,$role2]);
      Permission::create(['name' => 'tecnico.equipos.create'])->syncRoles([$role1,$role2]);
      Permission::create(['name' => 'tecnico.equipos.edit'])->syncRoles([$role1,$role2]);
      Permission::create(['name' => 'tecnico.equipos.destroy'])->syncRoles([$role1,$role2]);



    }
}
