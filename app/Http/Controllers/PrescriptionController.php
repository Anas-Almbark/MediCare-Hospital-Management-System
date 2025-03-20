<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with(['doctor', 'patient'])->paginate(10);
        return view('dashboard.prescriptions.index', compact('prescriptions'));
    }

    public function create()
    {
        $doctors = User::role('doctor')->get();
        $patients = User::role('patient')->get();
        return view('dashboard.prescriptions.create', compact('doctors', 'patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor' => 'required|exists:users,id',
            'patient' => 'required|exists:users,id',
            'description' => 'required|string',

        ]);

        Prescription::create($request->all());
        return redirect()->route('prescription.index')->with('success', 'Prescription created successfully');
    }

    public function show($id)
    {
        $prescription = Prescription::with(['doctor', 'patient'])->findOrFail($id);
        return view('dashboard.prescriptions.show', compact('prescription'));
    }

    public function edit($id)
    {
        $prescription = Prescription::findOrFail($id);
        $doctors = User::role('doctor')->get();
        $patients = User::role('patient')->get();
        return view('dashboard.prescriptions.edit', compact('prescription', 'doctors', 'patients'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor' => 'required|exists:users,id',
            'patient' => 'required|exists:users,id',
            'description' => 'required|string',
        ]);

        $prescription = Prescription::findOrFail($id);
        $prescription->update($request->all());
        return redirect()->route('prescription.index')->with('success', 'Prescription updated successfully');
    }

    public function destroy($id)
    {
        $prescription = Prescription::findOrFail($id);
        $prescription->delete();
        return redirect()->route('prescription.index')->with('success', 'Prescription deleted successfully');
    }
}
