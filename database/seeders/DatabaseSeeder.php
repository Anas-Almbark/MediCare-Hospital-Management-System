<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            SpecializationSeeder::class,
            LabTypeSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            StaticSalarySeeder::class,
            SalarySeeder::class,
            DoctorScheduleSeeder::class
        ]);
    }
}
