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
            'university.create','university.edit','university.update','university.delete',
            'program.create','program.edit','program.update','program.delete',
            'destination.view','destination.create','destination.edit','destination.update','destination.delete',
            'program-level.view','program-level.create','program-level.edit','program-level.update','program-level.delete',
            'field-of-study.view','field-of-study.create','field-of-study.edit','field-of-study.update','field-of-study.delete',
            'subject.view','subject.create','subject.edit','subject.update','subject.delete',
            'intake.view','intake.create','intake.edit','intake.update','intake.delete',
            'intake-month.view','intake-month.create','intake-month.edit','intake-month.update','intake-month.delete',
            'program-tag.view','program-tag.create','program-tag.edit','program-tag.update','program-tag.delete',
            'student.view','student.update','agent.view','agent.update',
            'task.view','task.view.agent','task.view.student','task.create','task.edit','task.update','task.delete','task.assign',
            'transaction.view','transaction.create','transaction.update','transaction.delete',
            'application.view','application.edit','agent.employee.manage'
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
