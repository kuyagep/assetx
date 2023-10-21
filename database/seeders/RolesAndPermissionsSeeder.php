<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
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
        //create Permission Groups
        PermissionGroup::create(['name' => 'Dashboard']);
        PermissionGroup::create(['name' => 'Purchase']);
        PermissionGroup::create(['name' => 'Accountability']);
        PermissionGroup::create(['name' => 'Classification']);
        PermissionGroup::create(['name' => 'Asset Status']);
        PermissionGroup::create(['name' => 'Assets']);
        PermissionGroup::create(['name' => 'Issuance Type']);
        PermissionGroup::create(['name' => 'All Issuance']);
        PermissionGroup::create(['name' => 'Division']);
        PermissionGroup::create(['name' => 'District']);
        PermissionGroup::create(['name' => 'School']);
        PermissionGroup::create(['name' => 'Office']);
        PermissionGroup::create(['name' => 'Position']);
        PermissionGroup::create(['name' => 'User']);
        PermissionGroup::create(['name' => 'Admin']);
        PermissionGroup::create(['name' => 'Reports']);
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