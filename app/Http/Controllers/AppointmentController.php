<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\AppointmentStatusChanged;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;
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
        $doctors = User::role('doctor')
            ->with([
                'doctor.specialization',
                'schedules.appointments' => function($query) {
                    $query->where('date', '>=', now())
                          ->where('status', 'available');
                }
            ])
            ->get();
    
        // للتحقق من البيانات
    Log::info('Doctors data:', $doctors->toArray());
    
        return view('indexTemplate.profileuser.appointments.available', compact('doctors'));
    }

    public function bookAppointment(Appointment $appointment)
    {
        try {
            $appointment->update([
                'status' => 'pending',
                'patient_id' => auth()->id()
            ]);
    
            $doctor = User::findOrFail($appointment->doctor_id);
            Notification::send($doctor, new AppointmentStatusChanged($appointment, 'pending'));
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Booking error: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to book appointment'], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->notes = $request->notes;
        $appointment->save();
    
        if ($request->status === 'confirmed') {
            \Illuminate\Support\Facades\DB::table('notifications')->insert([
                'receiver' => $appointment->patient_id,
                'message' => "Your appointment on " . $appointment->date . " at " . 
                    \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') . 
                    " has been confirmed☑️ by Dr. " . auth()->user()->name,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        elseif ($request->status === 'rejected') {
            \Illuminate\Support\Facades\DB::table('notifications')->insert([
                'receiver' => $appointment->patient_id,
                'message' => "Your appointment on " . $appointment->date . " has been rejected❌ by Dr. " . 
                    auth()->user()->name . ". Reason: " . ($request->notes ?? 'No reason provided'),
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    
        return redirect()->back()->with('success', 'Appointment status updated successfully');
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

    public function showAvailable()
    {
        $doctors = User::role('doctor')
            ->with(['doctor.specialization', 'schedules.appointments' => function($query) {
                $query->where('status', 'available');
            }])
            ->get();

        return view('indexTemplate.profileuser.appointments.available', compact('doctors'));
    }

    public function book(Request $request)
    {
        $appointment = Appointment::findOrFail($request->appointment_id);
        $appointment->update([
            'status' => 'booked',
            'patient_id' => auth()->id()
        ]);
    
        return redirect()->back()->with('success', 'Appointment booked successfully!');
    }
}
