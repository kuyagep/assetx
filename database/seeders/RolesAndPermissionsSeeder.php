<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
         // create permissions
        //* Permission::create(['name' => 'menu']);
        //* Permission::create(['name' => 'view']);
        //* Permission::create(['name' => 'edit']);
        //* Permission::create(['name' => 'destroy']);
        //* Permission::create(['name' => 'add']);
        //* Permission::create(['name' => 'update']);

        // create roles and assign created permissions
        $role = Role::create(['name' => 'super-admin']);
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'client']);
    }
}