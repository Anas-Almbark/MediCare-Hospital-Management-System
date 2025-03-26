<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class PatientAppointmentController extends Controller
{
    public function index(Request $request)
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

        $appointments = $query->orderBy('date')
            ->orderBy('start_time')
            ->paginate(10);

        $doctors = User::role('doctor')->get();

        return view('patient.appointments.index', compact('appointments', 'doctors'));
    }

    public function myAppointments()
    {
        $appointments = Appointment::with('doctor')
            ->where('patient_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('patient.appointments.my-appointments', compact('appointments'));
    }

    public function book(Appointment $appointment)
    {
        if ($appointment->status !== 'available') {
            return back()->with('error', 'هذا الموعد لم يعد متاحاً');
        }

        $appointment->update([
            'patient_id' => auth()->id(),
            'status' => 'pending'
        ]);

        return back()->with('success', 'تم حجز الموعد بنجاح وبانتظار تأكيد الطبيب');
    }

    public function cancel(Appointment $appointment)
    {
        if ($appointment->patient_id !== auth()->id()) {
            return back()->with('error', 'غير مصرح لك بإلغاء هذا الموعد');
        }

        $appointment->update([
            'status' => 'cancelled',
            'patient_id' => null
        ]);

        return back()->with('success', 'تم إلغاء الموعد بنجاح');
    }
}