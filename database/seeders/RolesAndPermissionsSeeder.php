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
        PermissionGroup::create(['name' => 'Purchase Request']);
        PermissionGroup::create(['name' => 'Accountability']);
        PermissionGroup::create(['name' => 'Classifications']);
        PermissionGroup::create(['name' => 'Asset Status']);
        PermissionGroup::create(['name' => 'Assets']);
        PermissionGroup::create(['name' => 'Issuance Type']);
        PermissionGroup::create(['name' => 'All Issuances']);
        PermissionGroup::create(['name' => 'Divisions']);
        PermissionGroup::create(['name' => 'Districts']);
        PermissionGroup::create(['name' => 'Schools']);
        PermissionGroup::create(['name' => 'Offices']);
        PermissionGroup::create(['name' => 'Positions']);
        PermissionGroup::create(['name' => 'Permissions']);
        PermissionGroup::create(['name' => 'Permission Group']);
        PermissionGroup::create(['name' => 'Users']);
        PermissionGroup::create(['name' => 'Admins']);
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