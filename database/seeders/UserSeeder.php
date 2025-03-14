<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@gamil.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('12345678'),
            ]
        );
        $superAdmin->assignRole('super-admin');

        // Create Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@gamil.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
            ]
        );
        $admin->assignRole('admin');

        // Create Doctor
        $doctor = User::firstOrCreate(
            ['email' => 'doctor@gamil.com'],
            [
                'name' => 'Doctor',
                'password' => Hash::make('12345678'),
            ]
        );
        $doctor->assignRole('doctor');

        // Create Patient
        $patient = User::firstOrCreate(
            ['email' => 'patient@gamil.com'],
            [
                'name' => 'Patient',
                'password' => Hash::make('12345678'),
            ]
        );
        $patient->assignRole('patient');

        $nurse = User::firstOrCreate(
            ['email' => 'nurse@gamil.com'],
            [
                'name' => 'Nurse',
                'password' => Hash::make('12345678'),
            ]
        );
        $nurse->assignRole('nurse');
    }
}
