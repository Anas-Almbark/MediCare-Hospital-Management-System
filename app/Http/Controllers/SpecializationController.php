<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    
    public function index()
    {
        $specializations = Specialization::paginate(10);
        return view('dashboard.specializations.index', compact('specializations'));
    }

    public function create()
    {
        return view('dashboard.specializations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:specializations',
            'description' => 'nullable|string'
        ]);

        Specialization::create($validated);
        return redirect()->route('specialization.index')->with('success', 'Specialization created successfully');
    }

    public function edit(Specialization $specialization)
    {
        return view('dashboard.specializations.edit', compact('specialization'));
    }

    public function update(Request $request, Specialization $specialization)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:specializations,name,' . $specialization->id,
            'description' => 'nullable|string'
        ]);

        $specialization->update($validated);
        return redirect()->route('specialization.index')->with('success', 'Specialization updated successfully');
    }

    public function destroy(Specialization $specialization)
    {
        $specialization->delete();
        return redirect()->route('specialization.index')->with('success', 'Specialization deleted successfully');
    }
}
