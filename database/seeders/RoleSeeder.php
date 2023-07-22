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
      $role3 = Role::create(['name' => 'Usuario']);

    
      Permission::create(['name' => 'tecnico.proyectos.create'])->assignRole($role1);

      Permission::create(['name' => 'user.proyectos'])->assignRole($role3);
      Permission::create(['name' => 'tecnico.proyectos'])->assignRole($role2);


      Permission::create(['name' => 'admin.proyectos.destroy'])->assignRole($role1);
      Permission::create(['name' => 'tecnico.proyectos.index'])->syncRoles([$role2,$role1]);
      Permission::create(['name' => 'user.proyectos.index'])->syncRoles([$role1,$role2,$role3]);

      Permission::create(['name' => 'tecnico.equipos.index'])->syncRoles([$role1,$role2]);
      Permission::create(['name' => 'tecnico.equipos.create'])->syncRoles([$role1,$role2]);
      Permission::create(['name' => 'tecnico.equipos.edit'])->syncRoles([$role1,$role2]);
      Permission::create(['name' => 'tecnico.equipos.destroy'])->syncRoles([$role1,$role2]);



    }
}
