<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Middleware\AppointmentMiddleware;

class DoctorAppointmentController extends Controller
{
    protected $middleware;

    public function __construct()
    {
        $this->middleware = new AppointmentMiddleware();
    }

    public function index()
    {
        $appointmentDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $appointmentsByDay = [];

        // Check if user is super-admin
        $isAdmin = auth()->user()->hasRole('super-admin');
        $doctorId = $isAdmin ? request('doctor_id', null) : auth()->id();

        // Get appointments query
        $appointmentsQuery = Appointment::query();
        if ($doctorId) {
            $appointmentsQuery->where('doctor_id', $doctorId);
        }

        foreach ($appointmentDays as $day) {
            $appointmentsByDay[$day] = $appointmentsQuery->clone()
                ->where('day_of_week', $day)
                ->with(['patient', 'doctor'])
                ->orderBy('start_time')
                ->paginate(10, ['*'], "page_$day");
        }

        // Get statistics
        $statsQuery = $appointmentsQuery->clone();
        
        $availableAppointments = $statsQuery->clone()
            ->whereNull('patient_id')
            ->count();

        $bookedAppointments = $statsQuery->clone()
            ->whereNotNull('patient_id')
            ->where('status', 'confirmed')
            ->count();

        $pendingAppointments = $statsQuery->clone()
            ->where('status', 'pending')
            ->count();

        // Move today to first position
        $today = now()->format('l');
        $appointmentDays = collect($appointmentDays)
            ->filter(function($day) use ($appointmentsByDay) {
                return $appointmentsByDay[$day]->total() > 0;
            })
            ->values();
        
        if($appointmentDays->contains($today)) {
            $appointmentDays = $appointmentDays
                ->filter(function($day) use ($today) {
                    return $day !== $today;
                })
                ->prepend($today)
                ->values();
        }

        // Get doctors list for admin filter
        $doctors = $isAdmin ? User::role('doctor')->get() : null;

        return view('dashboard.appointments.doctor-appointments', 
            compact('appointmentsByDay', 'appointmentDays', 'availableAppointments', 
                    'bookedAppointments', 'pendingAppointments', 'doctors', 'doctorId'));
    }

    public function pending()
    {
        $pendingAppointments = Appointment::where('doctor_id', auth()->id())
            ->where('status', 'pending')
            ->with('patient')
            ->latest()
            ->paginate(10);
    
        return view('dashboard.appointments.pending', compact('pendingAppointments'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required',
            'notes' => 'nullable|string|max:500'
        ]);
    
        $appointment->update([
            'status' => $validated['status'],
            'notes' => $validated['notes']
        ]);
    
        $message = $validated['status'] === 'confirmed' 
            ? __('Appointment confirmed successfully') 
            : __('Appointment rejected successfully');
    
        return redirect()->back()
            ->with('success', $message);
    }

    public function addNotes(Request $request, Appointment $appointment)
    {
        if ($this->middleware->isDoctorUnauthorized($appointment)) {
            return back()->with('error', $this->middleware->getErrorMessage('doctor_unauthorized'));
        }

        $request->validate([
            'notes' => 'required|string|max:500'
        ]);

        $appointment->update([
            'notes' => $request->notes
        ]);

        return back()->with('success', 'Notes added successfully');
    }

    public function show(string $id)
    {
        $appointment = Appointment::with(['patient', 'doctor'])->findOrFail($id);
        
        if ($this->middleware->isDoctorUnauthorized($appointment)) {
            return back()->with('error', $this->middleware->getErrorMessage('doctor_unauthorized'));
        }

        return view('dashboard.appointments.show', compact('appointment'));
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        
        if ($this->middleware->isDoctorUnauthorized($appointment)) {
            return back()->with('error', $this->middleware->getErrorMessage('doctor_unauthorized'));
        }

        $appointment->delete();
        return redirect()->back()->with('success', 'Appointment deleted successfully');
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        
        if ($this->middleware->isDoctorUnauthorized($appointment)) {
            return back()->with('error', $this->middleware->getErrorMessage('doctor_unauthorized'));
        }

        $doctors = User::role('doctor')->get();
        $patients = User::role('patient')->get();
        return view('dashboard.appointments.edit', compact('appointment', 'doctors', 'patients'));
    }
}