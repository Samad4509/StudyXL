<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        // ---------------- Roles ----------------
        $roles = ['super-admin', 'admin-user', 'agent', 'agent-employee'];
        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'admin', // ✅ Guard fix
            ]);
        }

        // ---------------- Permissions ----------------
        $permissions = [
            'university.create',
            'university.edit',
            'university.delete',
            'program.create',
            'program.edit',
            'program.delete',
            'application.view',
            'application.edit',
            'task.create',
            'task.assign',
            'agent.employee.manage'
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate([
                'name' => $perm,
                'guard_name' => 'admin', // ✅ Guard fix
            ]);
        }

        // ---------------- Admin User ----------------
        $admin = Admin::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('1234'),
            ]
        );

        // Assign super-admin role
        $admin->assignRole('super-admin'); // ✅ Now works
        $admin->givePermissionTo(Permission::where('guard_name', 'admin')->get()); // optional
    }
}
