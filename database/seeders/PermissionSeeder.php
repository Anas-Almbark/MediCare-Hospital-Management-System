<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'create-user',
            'edit-user',
            'delete-user',
            'create-role',
            'edit-role',
            'delete-role',
            'create-permission',
            'edit-permission',
            'delete-permission',
            'create-bills',
            'edit-bills',
            'delete-bills',
            'create-prescription',
            'edit-prescription',
            'delete-prescription',
            'craete-medical-record',
            'edit-medical-record',
            'delete-medical-record',

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
