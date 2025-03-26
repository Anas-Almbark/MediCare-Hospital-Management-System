<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddLabTestRequest;
use App\Http\Requests\UpdateLabTestRequest;
use App\Models\User;
use App\Models\LabTest;
use App\Models\LabType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LabTestController extends Controller
{
    public function index()
    {
        $labTests = LabTest::with(['patientData', 'doctorData'])->paginate(10);
        $labTypes = LabType::all();
        return view('dashboard.lab-tests.index', compact('labTests', 'labTypes'));
    }

    public function create()
    {
        $doctors = User::role('doctor')->get();
        $patients = User::role('patient')->get();
        $labTypes = LabType::all();
        return view('dashboard.lab-tests.create', compact('doctors', 'patients', 'labTypes'));
    }

    public function store(AddLabTestRequest $request)
    {
        $validation =  $request->validated();
        $patientData = [
            ...$validation,
            'email' => $validation['phone_number'] . '@patient.com',
            'password' => bcrypt('password123'),
        ];

        $patient = User::create($patientData);
        $patient->assignRole('patient');

        $labTestData = [
            'patient' => $patient->id,
            'doctor' => $validation['doctor_id'],
            'lab_type_id' => $validation['lab_type_id'],
        ];

        LabTest::create($labTestData);

        return redirect()->route('lab-test.index')->with('success', 'Lab test created successfully');
    }

    public function show(LabTest $labTest)
    {
        return view('dashboard.lab-tests.show', compact('labTest'));
    }

    public function edit(LabTest $labTest)
    {
        $doctors = User::role('doctor')->get();
        $patients = User::role('patient')->get();
        $labTypes = LabType::all();
        return view('dashboard.lab-tests.edit', compact('labTest', 'doctors', 'patients', 'labTypes'));
    }

    public function update(UpdateLabTestRequest $request, LabTest $labTest)
    {
        $validation = $request->validated();
        if ($request->hasFile('result')) {
            if ($labTest->result) {
                Storage::disk('public')->delete($labTest->result);
            }
            $labTest->result = $request->file('result')->store('lab-tests', 'public');
        }
        $labTest->patientData->update($validation);
        $labTest->update(collect($validation)->except('result')->toArray());
        return redirect()->route('lab-test.index')->with('success', 'Lab test updated successfully');
    }

    public function destroy(LabTest $labTest)
    {
        $labTest->delete();
        return redirect()->route('lab-test.index')->with('success', 'Lab test deleted successfully');
    }
    public function searchByName(Request $request)
    {
        $labTests = User::search(request()->input('search'));
        return view('dashboard.lab-tests.index', compact('labTests'));
    }
}
