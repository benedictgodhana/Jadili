<?php
// database/seeders/UsersSeeder.php
// database/seeders/UsersSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Create Users and Assign Roles

        // Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'admission_number' => null,
            'staff_number' => 'STF001',
            'username' => 'adminuser',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        // Super Admin User
        $superAdmin = User::create([
            'name' => 'Super Admin User',
            'email' => 'superadmin@example.com',
            'admission_number' => null,
            'staff_number' => 'STF002',
            'username' => 'superadminuser',
            'password' => bcrypt('password'),
        ]);
        $superAdmin->assignRole('super-admin');

        // Student User
        $student = User::create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'admission_number' => 'ADM003',
            'staff_number' => null,
            'username' => 'studentuser',
            'password' => bcrypt('password'),
        ]);
        $student->assignRole('student');
    }
}
