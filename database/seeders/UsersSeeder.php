<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Ensure roles exist before assigning them to users
        $roles = [
            'admin' => 'Admin User',
            'super-admin' => 'Super Admin User',
            'content-creator' => 'Content Creator User',
            'data-analyst' => 'Data Analyst User',
            'support-staff' => 'Support Staff User',
            'local-coordinator' => 'Local Coordinator User',
            'moderator' => 'Moderator User',
            'viewer' => 'Viewer User',
        ];

        // Create roles if they don't exist
        foreach ($roles as $roleName => $roleTitle) {
            if (!Role::where('name', $roleName)->exists()) {
                Role::create(['name' => $roleName]);
            }
        }

        // Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone_number' => '1234567890',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        // Super Admin User
        $superAdmin = User::create([
            'name' => 'Super Admin User',
            'email' => 'superadmin@example.com',
            'phone_number' => '0987654321',
            'password' => bcrypt('password'),
        ]);
        $superAdmin->assignRole('super-admin');

        // Student User


        // Content Creator User
        $contentCreator = User::create([
            'name' => 'Content Creator User',
            'email' => 'contentcreator@example.com',
            'phone_number' => '2233445566',
            'password' => bcrypt('password'),
        ]);
        $contentCreator->assignRole('content-creator');

        // Data Analyst User
        $dataAnalyst = User::create([
            'name' => 'Data Analyst User',
            'email' => 'dataanalyst@example.com',
            'phone_number' => '3344556677',
            'password' => bcrypt('password'),
        ]);
        $dataAnalyst->assignRole('data-analyst');

        // Support Staff User
        $supportStaff = User::create([
            'name' => 'Support Staff User',
            'email' => 'supportstaff@example.com',
            'phone_number' => '4455667788',
            'password' => bcrypt('password'),
        ]);
        $supportStaff->assignRole('support-staff');

        // Local Coordinator User
        $localCoordinator = User::create([
            'name' => 'Local Coordinator User',
            'email' => 'localcoordinator@example.com',
            'phone_number' => '5566778899',
            'password' => bcrypt('password'),
        ]);
        $localCoordinator->assignRole('local-coordinator');

        // Moderator User
        $moderator = User::create([
            'name' => 'Moderator User',
            'email' => 'moderator@example.com',
            'phone_number' => '6677889900',
            'password' => bcrypt('password'),
        ]);
        $moderator->assignRole('moderator');

        // Viewer User
        $viewer = User::create([
            'name' => 'Viewer User',
            'email' => 'viewer@example.com',
            'phone_number' => '7788990011',
            'password' => bcrypt('password'),
        ]);
        $viewer->assignRole('viewer');
    }
}
