<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('12345678'),
            ]
        );
        $superAdmin->assignRole('super-admin');

        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
            ]
        );
        $admin->assignRole('admin');

        $doctor = User::firstOrCreate(
            ['email' => 'doctor@gmail.com'],
            [
                'name' => 'Doctor',
                'password' => Hash::make('12345678'),
            ]
        );
        $doctor->assignRole('doctor');

        $patient = User::firstOrCreate(
            ['email' => 'patient@gmail.com'],
            [
                'name' => 'Patient',
                'password' => Hash::make('12345678'),
            ]
        );
        $patient->assignRole('patient');

        $nurse = User::firstOrCreate(
            ['email' => 'nurse@gmail.com'],
            [
                'name' => 'Nurse',
                'password' => Hash::make('12345678'),
            ]
        );
        $nurse->assignRole('nurse');

        $receptionist = User::firstOrCreate(
            ['email' => 'receptionist@gmail.com'],
            [
                'name' => 'Receptionist',
                'password' => Hash::make('12345678'),
            ]
        );
        $receptionist->assignRole('receptionist');

        $accountant = User::firstOrCreate(
            ['email' => 'accountant@gmail.com'],
            [
                'name' => 'Accountant',
                'password' => Hash::make('12345678'),
            ]
        );
        $accountant->assignRole('accountant');

        $labTechnician = User::firstOrCreate(
            ['email' => 'lab.technician@gmail.com'],
            [
                'name' => 'Lab Technician',
                'password' => Hash::make('12345678'),
            ]
        );
        $labTechnician->assignRole('lab_technician');

        $doctorSecretary = User::firstOrCreate(
            ['email' => 'doctor.secretary@gmail.com'],
            [
                'name' => 'Doctor Secretary',
                'password' => Hash::make('12345678'),
            ]
        );
        $doctorSecretary->assignRole('doctor_secretary');

        for ($i = 1; $i <= 5; $i++) {
            $additionalPatient = User::firstOrCreate(
                ['email' => "patient{$i}@gmail.com"],
                [
                    'name' => "Patient {$i}",
                    'password' => Hash::make('12345678'),
                ]
            );
            $additionalPatient->assignRole('patient');
        }
    }
}
