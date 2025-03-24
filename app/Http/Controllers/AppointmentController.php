<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['doctor', 'patient'])->paginate(5);
        return view('dashboard.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $doctors = User::role('doctor')->get();
        $patients = User::role('patient')->get();
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
        
        Appointment::create($request->all());
        return redirect()->route('appointment.index')->with('success', 'Appointment created successfully');
    }

    public function show($id)
    {
        $appointment = Appointment::with([
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
        $appointment = Appointment::findOrFail($id);
        $doctors = User::role('doctor')->get();
        $patients = User::role('patient')->get();
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

        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());
        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->route('appointment.index')->with('success', 'Appointment deleted successfully');
    }

    public function doctorAppointments(Request $request)
    {
        $filter = $request->get('filter', 'today');
        $doctor = auth()->user();
    
        $query = Appointment::with('patient')
            ->where('doctor_id', $doctor->id);
    
        switch ($filter) {
            case 'today':
                $query->whereDate('date', today());
                break;
            case 'upcoming':
                $query->whereDate('date', '>', today());
                break;
            case 'past':
                $query->whereDate('date', '<', today());
                break;
        }
    
        $appointments = $query->orderBy('date')
            ->orderBy('start_time')
            ->paginate(10);
    
        return view('dashboard.appointments.doctor-appointments', compact('appointments'));
    }

    public function pendingAppointments()
    {
        $pendingAppointments = Appointment::where('doctor_id', auth()->id())
            ->where('status', 'pending')
            ->with('patient')
            ->latest()
            ->paginate(10);
    
        return view('dashboard.appointments.pending', compact('pendingAppointments'));
    }

    public function book(Appointment $appointment)
    {
        if ($appointment->status !== 'available') {
            return back()->with('error', __('This appointment is no longer available'));
        }
    
        $appointment->update([
            'patient_id' => auth()->id(),
            'status' => 'pending'
        ]);
    
        return redirect()->route('appointment.index')
            ->with('success', __('Appointment booked successfully'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:confirmed,rejected',
            'notes' => 'nullable|string|max:500'
        ]);
    
        $appointment->update([
            'status' => $validated['status'],
            'notes' => $validated['notes']
        ]);
    
        $message = $validated['status'] === 'confirmed' 
            ? __('Appointment confirmed successfully') 
            : __('Appointment rejected successfully');
    
        return redirect()->route('appointment.pending')
            ->with('success', $message);
    }

    public function cancelAppointment(Appointment $appointment)
    {
        if (!in_array($appointment->status, ['confirmed', 'pending'])) {
            return back()->with('error', __('This appointment cannot be cancelled'));
        }
    
        if ($appointment->patient_id !== auth()->id()) {
            return back()->with('error', __('You are not authorized to cancel this appointment'));
        }
    
        $appointment->update([
            'patient_id' => null,
            'status' => 'available',
        ]);
    
        return back()->with('success', __('Appointment cancelled successfully'));
    }

    public function updateNote(Request $request, Appointment $appointment)
    {
        $request->validate([
            'notes' => 'nullable|string|max:255'
        ]);

        $appointment->update([
            'notes' => $request->notes
        ]);

        return redirect()->back()
            ->with('success', __('Note updated successfully'));
    }

    public function myAppointments()
    {
        $appointments = Appointment::with(['doctor'])
            ->where('patient_id', auth()->id())
            ->orderBy('date')
            ->orderBy('start_time')
            ->paginate(10);
    
        return view('dashboard.appointments.my-appointments', compact('appointments'));
    }
}
