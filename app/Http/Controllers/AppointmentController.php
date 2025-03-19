<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = \App\Models\Appointment::with(['doctor', 'patient'])->paginate(5);
        return view('dashboard.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $doctors = \App\Models\User::role('doctor')->get();
        $patients = \App\Models\User::role('patient')->get();
        return view('dashboard.appointments.create', compact('doctors', 'patients'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'doctor' => 'required|exists:users,id',
            'patient' => 'required|exists:users,id',
            'date' => 'required|date',
            'status' => 'required|in:pending,confirmed,cancelled',
            'notes' => 'nullable|string'
        ]);
        \App\Models\Appointment::create($request->all());
        return redirect()->route('appointment.index')->with('success', 'Appointment created successfully');
    }

    public function show($id)
    {
        $appointment = \App\Models\Appointment::with([
            'doctor' => function($query) {
                $query->select('id', 'name', 'email');
            },
            'patient' => function($query) {
                $query->select('id', 'name', 'email');
            }
        ])->findOrFail($id);
        
        return view('dashboard.appointments.show', compact('appointment'));
    }

    public function edit($id)
    {
        $appointment = \App\Models\Appointment::findOrFail($id);
        $doctors = \App\Models\User::role('doctor')->get();
        $patients = \App\Models\User::role('patient')->get();
        return view('dashboard.appointments.edit', compact('appointment', 'doctors', 'patients'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'patient_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status' => 'required|in:scheduled,completed,cancelled',
            'notes' => 'nullable|string'
        ]);

        $appointment = \App\Models\Appointment::findOrFail($id);
        $appointment->update($request->all());
        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully');
    }

    public function destroy($id)
    {
        $appointment = \App\Models\Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->route('appointment.index')->with('success', 'Appointment deleted successfully');
    }
}
