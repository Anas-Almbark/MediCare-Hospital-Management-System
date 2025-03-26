<?php

namespace Database\Seeders;

use App\Models\LabType;
use Illuminate\Database\Seeder;

class LabTypeSeeder extends Seeder
{
    public function run()
    {
        $labTypes = [
            [
                'name' => 'Complete Blood Count (CBC)',
                'price' => 150
            ],
            [
                'name' => 'Blood Sugar Test',
                'price' => 100
            ],
            [
                'name' => 'Lipid Profile',
                'price' => 200
            ],
            [
                'name' => 'Liver Function Test',
                'price' => 250
            ],
            [
                'name' => 'Kidney Function Test',
                'price' => 250
            ],
            [
                'name' => 'Thyroid Function Test',
                'price' => 300
            ],
            [
                'name' => 'Urine Analysis',
                'price' => 120
            ],
            [
                'name' => 'COVID-19 PCR Test',
                'price' => 400
            ],
            [
                'name' => 'Vitamin D Test',
                'price' => 180
            ],
            [
                'name' => 'HbA1c Test',
                'price' => 160
            ]
        ];

        foreach ($labTypes as $labType) {
            LabType::create($labType);
        }
    }
}
