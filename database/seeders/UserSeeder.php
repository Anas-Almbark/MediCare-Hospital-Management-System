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

        // Create multiple doctors with detailed information
        $doctors = [
            [
                'name' => 'Dr. James Wilson',
                'email' => 'doctor@gmail.com',
                'password' => Hash::make('12345678'),
                'birth_date' => '1980-05-15',
                'gender' => 'male',
                'phone_number' => '+1234567890',
                'blood_type' => 'A+',
                'address' => '123 Medical Center Dr, City',
                'identity_number' => 'DOC10001',
                'status_account' => 'active'
            ],
            [
                'name' => 'Dr. Sarah Chen',
                'email' => 'doctor1@gmail.com',
                'password' => Hash::make('12345678'),
                'birth_date' => '1985-08-22',
                'gender' => 'female',
                'phone_number' => '+1234567891',
                'blood_type' => 'O+',
                'address' => '456 Hospital Ave, City',
                'identity_number' => 'DOC10002',
                'status_account' => 'active'
            ],
            [
                'name' => 'Dr. Michael Brown',
                'email' => 'doctor2@gmail.com',
                'password' => Hash::make('12345678'),
                'birth_date' => '1975-11-30',
                'gender' => 'male',
                'phone_number' => '+1234567892',
                'blood_type' => 'B+',
                'address' => '789 Health Blvd, City',
                'identity_number' => 'DOC10003',
                'status_account' => 'active'
            ],
            [
                'name' => 'Dr. Emily Taylor',
                'email' => 'doctor3@gmail.com',
                'password' => Hash::make('12345678'),
                'birth_date' => '1982-03-18',
                'gender' => 'female',
                'phone_number' => '+1234567893',
                'blood_type' => 'AB+',
                'address' => '321 Care Street, City',
                'identity_number' => 'DOC10004',
                'status_account' => 'active'
            ],
            [
                'name' => 'Dr. David Kim',
                'email' => 'doctor4@gmail.com',
                'password' => Hash::make('12345678'),
                'birth_date' => '1978-09-25',
                'gender' => 'male',
                'phone_number' => '+1234567894',
                'blood_type' => 'O-',
                'address' => '654 Wellness Road, City',
                'identity_number' => 'DOC10005',
                'status_account' => 'active'
            ]
        ];

        foreach ($doctors as $doctorData) {
            $doctor = User::firstOrCreate(
                ['email' => $doctorData['email']],
                $doctorData
            );
            $doctor->assignRole('doctor');

            // Create doctor record
            $doctorRecord = \App\Models\Doctor::create([
                'doctor' => $doctor->id,
                'specialization_id' => rand(1, 15),
                'license_number' => 'LIC-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                'experience_years' => rand(5, 25)
            ]);

            // Add doctor specialization relationship
            \Illuminate\Support\Facades\DB::table('doctor_specialization')->insert([
                'doctor_id' => $doctor->id, // تم تغييرها من $doctorRecord->id إلى $doctor->id
                'specialization_id' => $doctorRecord->specialization_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
