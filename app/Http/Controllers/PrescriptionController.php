<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
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

    public function create($id)
    {   
        $appointment = Appointment::with(['doctor', 'patient'])
            ->findOrFail($id);
       
        return view('dashboard.prescriptions.create', compact('appointment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor' => 'required|exists:users,id',
            'patient' => 'required|exists:users,id',
            'appointment_id' => 'required|exists:appointments,id',
            'description' => 'required|string|max:255',
        ]);
        
        $prescription = Prescription::create([
            'doctor_id' => $request->doctor,
            'patient_id' => $request->patient,
            'description' => $request->description,
            'appointment_id'=>$request->appointment_id
        ]);
        // Update the appointment with the prescription
        $appointment = Appointment::findOrFail($request->appointment_id);
        $appointment->update([
            'status' => 'completed'
        ]);

        return redirect()->route('prescription.index')
            ->with('success', 'تم إضافة الوصفة الطبية بنجاح');
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
