<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Prescription;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Middleware\AppointmentMiddleware;

class PatientAppointmentController extends Controller
{
    public function index()
    {
        // Remove the dd('ok') line as it's stopping the execution
        $currentDate = request('date', now()->format('Y-m-d'));
        $doctorId = request('doctor_id');

        $appointments = Appointment::with('doctor')
            ->whereDate('date', $currentDate)
            ->whereNull('patient_id')
            ->where('status', 'available')
            ->when($doctorId, function($query) use ($doctorId) {
                return $query->where('doctor_id', $doctorId);
            })
            ->paginate(8);

        $doctors = User::role('doctor')->get();
        return view('patient_pages.appointments.index', compact(
            'appointments', 
            'currentDate', 
            'doctors'
        ));
    }

    public function myAppointments()
    {
        $appointments = Appointment::with('doctor')
            ->where('patient_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('patient_pages.appointments.my-appointments', compact('appointments'));
    }

    public function bookAppointment(Appointment $appointment)
    {
        // Use middleware for validation
        $middleware = new AppointmentMiddleware();
        
        if ($appointment->status !== 'available') {
            return back()->with('error', __('This appointment is no longer available.'));
        }

        if ($middleware->isAppointmentBooked($appointment)) {
            return back()->with('error', $middleware->getErrorMessage('booked'));
        }

        if ($middleware->hasTimeConflict($appointment)) {
            return back()->with('error', $middleware->getErrorMessage('time_conflict'));
        }

        if ($middleware->hasReachedDoctorLimit($appointment)) {
            return back()->with('error', $middleware->getErrorMessage('doctor_limit'));
        }

        // حجز الموعد
        $appointment->update([
            'patient_id' => auth()->id(),
            'status' => 'pending'
        ]);
    
        return redirect()->back()
            ->with('success', __('Appointment booked successfully. Waiting for doctor confirmation.'));
    }

    public function cancel(Appointment $appointment)
    {
        $middleware = new AppointmentMiddleware();
        
        if ($middleware->isUnauthorizedAccess($appointment)) {
            return back()->with('error', $middleware->getErrorMessage('unauthorized'));
        }

        $appointment->update([
            'status' => 'cancelled',
            'patient_id' => null
        ]);

        return back()->with('success', 'Appointment cancelled successfully');
    }

    public function show(Appointment $appointment)
    {
        $middleware = new AppointmentMiddleware();
        
        if ($middleware->isUnauthorizedAccess($appointment)) {
            return redirect()->route('patient.appointments')
                ->with('error', $middleware->getErrorMessage('unauthorized'));
        }
        
        $appointment = Appointment::with([
            'doctor.user' => function($query) {
                $query->select('id', 'name', 'email');
            },
            'doctor.specialization:id,name',
            'prescription.doctor:id,name'  // Updated this line
        ])->findOrFail($appointment->id);

        return view('patient_pages.appointments.show', compact('appointment'));
    }

    public function downloadPrescription(Prescription $prescription)
    {
        $middleware = new AppointmentMiddleware();
        
        if ($middleware->isUnauthorizedAccess($prescription->appointment)) {
            return back()->with('error', $middleware->getErrorMessage('unauthorized'));
        }

        $pdf = PDF::loadView('pdf.prescription', [
            'prescription' => $prescription->load(['doctor', 'patient', 'appointment'])
        ]);

        $fileName = 'prescription_' . $prescription->id . '_' . now()->format('Y-m-d') . '.pdf';
        
        return $pdf->download($fileName);
    }
    public function create()
    {
        $doctors = User::role('doctor')->get();
        $patients = User::role('patient')->get();
        return view('dashboard.appointments.create', compact('doctors', 'patients'));
    }
}