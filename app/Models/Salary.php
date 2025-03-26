<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'employee',
        'base_salary',
        'bonus',
        'deductions',
        'net_salary',
        'payment_date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'employee');
    }
    public function staticSalary()
    {
        return $this->hasOneThrough(StaticSalary::class, User::class, 'id', 'employee', 'employee', 'id');
    }
    public static function monthlySalaries()
    {
        $currentMonth = self::whereMonth('payment_date', now()->month)->get();
        return $currentMonth->sum(function ($salary) {
            return $salary->base_salary + $salary->bonus - $salary->deductions;
        });
    }
    public function netSalary()
    {
        return $this->base_salary + $this->bonus - $this->deductions;
    }
    public static function monthlyPayments()
    {
        return self::whereMonth('payment_date', now()->month)->get();
    }
}
