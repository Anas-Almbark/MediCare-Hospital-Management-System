<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    public function run()
    {
        $specializations = [
            'Cardiology',
            'Dermatology',
            'Pediatrics',
            'Orthopedics',
            'Neurology',
            'Ophthalmology',
            'ENT',
            'Psychiatry',
            'Dentistry',
            'Gynecology',
            'Internal Medicine',
            'General Surgery',
            'Urology',
            'Endocrinology',
            'Oncology'
        ];

        foreach ($specializations as $name) {
            Specialization::create(['name' => $name]);
        }
    }
}
