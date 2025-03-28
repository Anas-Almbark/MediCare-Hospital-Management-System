<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        // Get all doctors
        $doctors = User::role('doctor')->get();
    
        // Build the query for available appointments
        $query = Appointment::with('doctor')
            ->where('status', 'available')
            ->whereDate('date', '>=', now());
    
        // Filter by doctor if selected
        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->doctor_id);
        }
    
        // Filter by date if selected
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }
    
        // Filter by time of day if selected
        if ($request->filled('time_of_day')) {
            switch ($request->time_of_day) {
                case 'morning':
                    $query->whereTime('start_time', '>=', '06:00:00')
                          ->whereTime('start_time', '<', '12:00:00');
                    break;
                case 'afternoon':
                    $query->whereTime('start_time', '>=', '12:00:00')
                          ->whereTime('start_time', '<', '17:00:00');
                    break;
                case 'evening':
                    $query->whereTime('start_time', '>=', '17:00:00')
                          ->whereTime('start_time', '<', '22:00:00');
                    break;
            }
        }
    
        // Get appointments ordered by date and time
        $appointments = $query->orderBy('date')
            ->orderBy('start_time')
            ->paginate(12)
            ->withQueryString();
    
        return view('patient_pages.appointments.index', compact('appointments', 'doctors'));
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

    public function show(string $id)
    {
        $appointment = Appointment::with(['patient', 'doctor'])->findOrFail($id);
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
        return redirect()->back()->with('success', 'Appointment deleted successfully');
    }

    public function doctorAppointments(Request $request)
    {
        $query = Appointment::with('patient')
            ->where('doctor_id', auth()->id());
    
        // Filter by date
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }
    
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        // Filter by time range
        if ($request->filled('time_range')) {
            switch ($request->time_range) {
                case 'morning':
                    $query->whereTime('start_time', '>=', '06:00:00')
                          ->whereTime('start_time', '<', '12:00:00');
                    break;
                case 'afternoon':
                    $query->whereTime('start_time', '>=', '12:00:00')
                          ->whereTime('start_time', '<', '17:00:00');
                    break;
                case 'evening':
                    $query->whereTime('start_time', '>=', '17:00:00')
                          ->whereTime('start_time', '<', '22:00:00');
                    break;
            }
        }
    
        $appointments = $query->orderBy('date')
            ->orderBy('start_time')
            ->paginate(10)
            ->withQueryString();
    
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

    public function availableAppointments(Request $request)
    {
        $query = Appointment::with('doctor')
            ->where('status', 'available')
            ->whereDate('date', '>=', now());
    
        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->doctor_id);
        }
    
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }
    
        if ($request->filled('time_of_day')) {
            switch ($request->time_of_day) {
                case 'morning':
                    $query->whereTime('start_time', '>=', '06:00:00')
                          ->whereTime('start_time', '<', '12:00:00');
                    break;
                case 'afternoon':
                    $query->whereTime('start_time', '>=', '12:00:00')
                          ->whereTime('start_time', '<', '17:00:00');
                    break;
                case 'evening':
                    $query->whereTime('start_time', '>=', '17:00:00')
                          ->whereTime('start_time', '<', '22:00:00');
                    break;
            }
        }
    
        $appointments = $query->orderBy('date')
            ->orderBy('start_time')
            ->paginate(12)
            ->withQueryString();
    
        $doctors = User::role('doctor')->get();
    
        return view('patient_pages.appointments.index', compact('appointments', 'doctors'));
    }

    public function bookAppointment(Appointment $appointment)
    {
        // التحقق من أن الموعد متاح
        if ($appointment->status !== 'available') {
            return back()->with('error', __('This appointment is no longer available.'));
        }
    
        // التحقق من أن المستخدم ليس لديه موعد في نفس الوقت
        $hasConflict = Appointment::where('patient_id', auth()->id())
            ->where('date', $appointment->date)
            ->where('start_time', $appointment->start_time)
            ->exists();
    
        if ($hasConflict) {
            return back()->with('error', __('You already have an appointment at this time.'));
        }
    
        // حجز الموعد
        $appointment->update([
            'patient_id' => auth()->id(),
            'status' => 'pending'
        ]);
    
        return redirect()->back()
            ->with('success', __('Appointment booked successfully. Waiting for doctor confirmation.'));
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
        $appointments = Appointment::with(['doctor', 'patient'])
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        $appointmentDays = $appointments->pluck('day_of_week')->unique()->values();
        
        // Move today to the first tab
        $today = now()->format('l');
        if($appointmentDays->contains($today)) {
            $appointmentDays = $appointmentDays->filter(function($day) use ($today) {
                return $day !== $today;
            })->prepend($today);
        }

        return view('dashboard.appointments.index', compact('appointments', 'appointmentDays'));
    }

    public function cancelAppointment(Appointment $appointment)
    {
        if ($appointment->patient_id !== auth()->id()) {
            return back()->with('error', __('You are not authorized to cancel this appointment.'));
        }
    
        if ($appointment->status !== 'pending') {
            return back()->with('error', __('This appointment cannot be cancelled.'));
        }
    
        $appointment->update(['status' => 'cancelled']);
    
        return back()->with('success', __('Appointment cancelled successfully.'));
    }
}
