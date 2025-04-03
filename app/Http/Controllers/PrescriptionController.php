<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddLabTestRequest;
use App\Models\Appointment;
use App\Models\LabTest;
use App\Models\LabType;
use App\Models\User;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with(['doctor', 'patient'])->paginate(10);
        return view('dashboard.prescriptions.index', compact('prescriptions'));
    }

    public function create($id)
    {
        $appointment = Appointment::with(['doctor', 'patient'])
            ->findOrFail($id);
        $labTypes = LabType::all();
        return view('dashboard.prescriptions.create', compact('appointment', 'labTypes'));
    }

    public function store(Request $request)
    {
        $validation =  $request->validate([
            'name' => $request->has('add_lab_test') ? 'required|string|max:255' : 'nullable|string|max:255',
            'gender' => $request->has('add_lab_test') ? 'required|string|max:255' : 'nullable|string|max:255',
            'phone_number' =>  $request->has('add_lab_test') ? 'required|string|max:255' : 'nullable|string|max:255',
            'identity_number' => $request->has('add_lab_test') ? 'required|string|max:255' : 'nullable|string|max:255',
            'lab_type_id' =>  $request->has('add_lab_test') ? 'required|exists:lab_types,id' : 'nullable|exists:lab_types,id',
            'doctor' => 'required|exists:users,id',
            'patient' => 'required|exists:users,id',
            'appointment_id' => 'required|exists:appointments,id',
            'description' => 'required|string|max:255',
        ]);
        if ($request->has('add_lab_test')) {
            $labTestData = [
                'patient' => $validation['patient'],
                'doctor' => $validation['doctor'] ?? null,
                'lab_type_id' => $validation['lab_type_id'],
            ];
            LabTest::create($labTestData);
        }
        $prescription = Prescription::create([
            'doctor_id' => $validation['doctor'],
            'patient_id' => $validation['patient'],
            'description' => $validation['description'],
            'appointment_id' => $validation['appointment_id']
        ]);
        $appointment = Appointment::findOrFail($validation['appointment_id']);
        $appointment->update([
            'status' => 'completed'
        ]);

        return redirect()->route('prescription.index')
            ->with('success', 'Prescription created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor' => 'required|exists:users,id',
            'patient' => 'required|exists:users,id',
            'description' => 'required|string|max:255',
        ]);

        $prescription = Prescription::findOrFail($id);
        $prescription->update($request->all());
        return redirect()->route('prescription.index')->with('success', 'Prescription updated successfully');
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



    public function destroy($id)
    {
        $prescription = Prescription::findOrFail($id);
        $prescription->delete();
        return redirect()->route('prescription.index')->with('success', 'Prescription deleted successfully');
    }
}
