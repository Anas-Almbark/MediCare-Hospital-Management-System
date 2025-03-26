<?php

namespace App\Http\Controllers;

use App\Models\LabType;
use Illuminate\Http\Request;

class LabTypeController extends Controller
{
    public function index(Request $request)
    {
        $labTypes = LabType::filterRange($request);
        return view('dashboard.lab_types.index', compact('labTypes'));
    }
    public function create()
    {
        return view('dashboard.lab_types.create');
    }
    public function store(Request $request)
    {
        $validation = $request->validate([
            "name" => "required|string|min:1|max:255",
            "price" => "required|numeric|min:1"
        ]);

        LabType::create($validation);
        return redirect()->route('lab-type.index')->with('success', 'Lab Type created successfully');
    }
    public function edit(LabType $labType)
    {
        return view('dashboard.lab_types.edit', compact('labType'));
    }
    public function update(Request $request, LabType $labType)
    {
        $validation = $request->validate([
            "name" => "sometimes|string|min:1|max:255",
            "price" => "sometimes|numeric|min:1"
        ]);
        $labType->update($validation);
        return redirect()->route('lab-type.index')->with('success', 'Lab Type updated successfully');
    }
    public function destroy(LabType $labType)
    {
        $labType->delete();
        return redirect()->route('lab-type.index')->with('success', 'Lab Type deleted successfully');
    }
}
