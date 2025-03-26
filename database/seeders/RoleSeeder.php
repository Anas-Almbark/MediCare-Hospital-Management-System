<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'super-admin',
            'admin',
            'doctor',
            'patient',
            'nurse',
            'receptionist',
            'accountant',
            'lab_technician',
            'doctor_secretary',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
}
