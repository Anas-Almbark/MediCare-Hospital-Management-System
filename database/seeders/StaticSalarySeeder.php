<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaticSalarySeeder extends Seeder
{
    public function run()
    {
        // Get all users except patients
        $employees = User::whereHas('roles', function($query) {
            $query->where('name', '!=', 'patient');
        })->get();

        foreach ($employees as $employee) {
            $salary = $this->getSalaryByRole($employee);
            
            DB::table('static_salaries')->insert([
                'employee' => $employee->id,
                'salary' => $salary
            ]);
        }
    }

    private function getSalaryByRole($employee)
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
        return $roleSalaries[$role] ?? 5000; // Default salary if role not found
    }
}