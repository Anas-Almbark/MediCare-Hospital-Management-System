<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddStaticSalaryRequest;
use App\Models\StaticSalary;
use App\Models\User;
use Illuminate\Http\Request;

class StaticSalaryController extends Controller
{
    public function index()
    {
        $static_salaries = StaticSalary::all();
        $employees = User::all();
        return view('dashboard.static_salaries.index', compact('static_salaries', 'employees'));
    }
    public function create()
    {
        $employees = User::all();
        return view('dashboard.static_salaries.create', compact('employees'));
    }
    public function store(AddStaticSalaryRequest $request)
    {
        $validated = $request->validated();
        StaticSalary::create($validated);
        return redirect()->route('staticSalaries.index');
    }
    public function edit(StaticSalary $salary)
    {
        return view('dashboard.static_salaries.edit', compact('salary'));
    }
    public function update(Request $request, StaticSalary $salary)
    {
        $validated = $request->validate([
            'salary' => 'required|numeric|min:1',
        ]);
        $salary->update($validated);
        return redirect()->route('staticSalaries.index')->with('success', 'Static salary updated successfully');
    }
    public function destroy(StaticSalary $id)
    {
        $id->delete();
        return redirect()->route('staticSalaries.index')->with('success', 'Static salary deleted successfully');
    }
}
