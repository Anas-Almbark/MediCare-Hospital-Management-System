<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class PatientAppointmentController extends Controller
{
    public function index()
    {
        $currentDate = request('date', now()->format('Y-m-d'));
        $appointments = Appointment::with('doctor')
            ->whereDate('date', $currentDate)
            ->whereNull('patient_id')
            ->where('status', 'available')
            ->paginate(9);

        return view('patient_pages.appointments.index', compact('appointments', 'currentDate'));
    }

    public function myAppointments()
    {
        $appointments = Appointment::with('doctor')
            ->where('patient_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('patient_pages.appointments.my-appointments', compact('appointments'));
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