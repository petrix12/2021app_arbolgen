<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolAdmin = Role::create(['name' => 'Admin']);
        $rolFamiliar = Role::create(['name' => 'Familiar']);
        $rolVisitante = Role::create(['name' => 'Visitante']);

        Permission::create(['name' => 'Admin'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Ver dashboard'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Listar role'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Crear role'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Editar role'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Eliminar role'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Leer usuarios'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Editar usuarios'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Eliminar usuarios'])->syncRoles($rolAdmin);

        Permission::create(['name' => 'VerArboles'])->syncRoles($rolAdmin, $rolFamiliar, $rolVisitante);
    }
}
