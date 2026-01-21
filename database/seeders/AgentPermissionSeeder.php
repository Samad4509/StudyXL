<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AgentPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Auth
            
            'agent.profile.view',           // GET agent/profile

            // Employee Management
            'employee.create',              // POST employee/create
            'employee.login',               // POST employee/login (employee login)
            'employee.view',                // GET employees

            // Students Management
            'student.view.all',             // GET all/agent-student
            'student.create',               // POST agent-student/register
            'student.view.by-agent',        // GET agentByreg
            'student.edit',                 // GET agent-student/edit/{id}
            'student.update',               // POST agent-student/update/{id}
            'student.delete',               // DELETE agent-student/delete/{id}

            // Applications
            'application.view.info',        // GET student/info/{student_id}/{program_id}
            'application.create',           // POST my-applications
            'application.view.all',         // GET my-applications
            'application.edit',             // GET applications/{id} (edit single)
            'application.update',           // PUT/POST applications/{id}
            'application.delete',           // DELETE applications/{id}
            'application.detail',           // GET applications/{id}/detail

            // Tasks
            'task.view',                    // GET tasks
            'task.update',                  // POST tasks/{task}/update

            // Transactions / Commissions
            'transaction.view',             // GET transactions
        ];


        foreach ($permissions as $perm) {
            Permission::firstOrCreate([
                'name' => $perm,
                'guard_name' => 'agent', // ✅ Must match Agent model
            ]);
        }

        $this->command->info('Agent permissions created successfully!');
    }
}
