<?php

namespace App\Http\Controllers;

use App\Events\UserNotificationEvent;
use App\Http\Requests\SalaryRequest;
use App\Http\Requests\UpdateSalaryRequest;
use App\Models\Salary;
use App\Models\User;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::all();
        $monthlySalaries = Salary::monthlySalaries();
        $employees = User::employees();
        $monthlyPayments = Salary::monthlyPayments();
        return view('dashboard.salaries.index', compact('salaries', 'employees', 'monthlySalaries', 'monthlyPayments'));
    }
    public function create()
    {
        $users = User::notHaveSalaryThisMonth();
        return view('dashboard.salaries.create', compact('users'));
    }
    public function store(SalaryRequest $request)
    {
        $validation = $request->validated();
        Salary::create($validation);
        broadcast(new UserNotificationEvent($validation['employee'], 'Salary created successfully'));
        return redirect()->route('salaries.index')->with('success', 'Salary created successfully');
    }
    public function edit(Salary $salary)
    {
        return view('dashboard.salaries.edit', compact('salary'));
    }
    public function update(UpdateSalaryRequest $request, Salary $salary)
    {
        $validation = $request->validated();
        $salary->update($validation);
        return redirect()->route('salaries.index')->with('success', 'Salary updated successfully');
    }
    public function destroy(Salary $id)
    {
        $id->delete();
        return redirect()->route('salaries.index')->with('success', 'Salary deleted successfully');
    }
}
