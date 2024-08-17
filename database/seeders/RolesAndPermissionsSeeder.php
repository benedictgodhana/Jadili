<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'regional_manager']);
        Role::create(['name' => 'content_creator']);
        Role::create(['name' => 'data_analyst']);
        Role::create(['name' => 'support_staff']);
        Role::create(['name' => 'local_coordinator']);
        Role::create(['name' => 'moderator']);
        Role::create(['name' => 'viewer']);

        // Create permissions
        Permission::create(['name' => 'view reports']);
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'edit content']);
        Permission::create(['name' => 'analyze data']);
        Permission::create(['name' => 'provide support']);


        // Create roles and assign created permissions

        // Student role
       
        // Admin role
        $role = Role::findByName('admin');
        $role->givePermissionTo(Permission::all());


        $role = Role::findByName('data_analyst');
        $role->givePermissionTo('analyze data');

        // Super-admin role
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all()); // Grant all permissions
    }
}
