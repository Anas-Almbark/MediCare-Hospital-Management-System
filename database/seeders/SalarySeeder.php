<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalarySeeder extends Seeder
{
    public function run()
    {
        $employees = User::whereHas('roles', function($query) {
            $query->where('name', '!=', 'patient');
        })->get();

        $months = [
            Carbon::now()->subMonths(2),
            Carbon::now()->subMonths(1),
            Carbon::now()
        ];

        foreach ($employees as $employee) {
            $baseSalary = $this->getBaseSalary($employee);
            
            foreach ($months as $month) {
                DB::table('salaries')->insert([
                    'employee' => $employee->id,
                    'base_salary' => $baseSalary,
                    'bonus' => $this->generateBonus($baseSalary),
                    'deductions' => $this->generateDeductions($baseSalary),
                    'payment_date' => $month->format('Y-m-25'),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }

    private function getBaseSalary($employee)
    {
        $roleSalaries = [
            'super-admin' => 12000,
            'admin' => 8000,
            'doctor' => 15000,
            'nurse' => 5000,
            'receptionist' => 4000,
            'accountant' => 6000,
            'lab_technician' => 5500,
            'doctor_secretary' => 4500
        ];

        $role = $employee->roles->first()->name;
        return $roleSalaries[$role] ?? 5000;
    }

    private function generateBonus($baseSalary)
    {
        // Random bonus between 0% and 10% of base salary
        return rand(0, $baseSalary * 0.1);
    }

    private function generateDeductions($baseSalary)
    {
        // Random deductions between 0% and 5% of base salary
        return rand(0, $baseSalary * 0.05);
    }
}