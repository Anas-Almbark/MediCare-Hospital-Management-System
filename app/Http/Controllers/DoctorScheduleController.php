<?php

namespace App\Http\Controllers;

use App\Models\DoctorSchedule;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;

class DoctorScheduleController extends Controller
{
    public function index()
    {
        $schedules = DoctorSchedule::with(['doctor' => function($query) {
            $query->select('id', 'name');
        }])
        ->orderBy('day_of_week')
        ->orderBy('start_time')
        ->paginate(10);

        return view('dashboard.doctor-schedules.index', compact('schedules'));
    }

    public function create()
    {
        if (!auth()->user()->hasRole('doctor')) {
            return redirect()->route('doctor.schedules.index')
                ->with('error', __('Unauthorized access'));
        }

        return view('dashboard.doctor-schedules.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'day_of_week' => 'required|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'required|date_format:H:i',
            'date' =>'required|date_format:Y-m-d',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'appointment_duration' => 'required|integer|min:15|max:120'
        ]);

        $schedule = DoctorSchedule::create($validated);

        // Generate appointment slots
        $start = strtotime($validated['start_time']);
        $end = strtotime($validated['end_time']);
        $duration = $validated['appointment_duration'] * 60; // Convert to seconds

        $appointments = [];
        for ($time = $start; $time < $end; $time += $duration) {
            $appointments[] = [
                'doctor_id' => $validated['doctor_id'],
                'schedule_id' => $schedule->id,
                'date' => $validated['date'],
                'start_time' => date('H:i:s', $time),
                'end_time' => date('H:i:s', min($time + $duration, $end)),
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Bulk insert appointments
        \App\Models\Appointment::insert($appointments);

        return redirect()->route('doctor.schedules.index')
            ->with('success', __('Schedule created successfully with available appointments'));
    }

    public function edit(DoctorSchedule $doctorSchedule)
    {
        // Ensure the doctor can only edit their own schedules
        if (auth()->user()->hasRole('doctor') && $doctorSchedule->doctor_id !== auth()->id()) {
            return redirect()->route('doctor.schedules.index')
                ->with('error', __('You are not authorized to edit this schedule'));
        }

        return view('dashboard.doctor-schedules.edit', ['schedule' => $doctorSchedule]);
    }

    public function update(Request $request, DoctorSchedule $doctorSchedule)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'day_of_week' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'appointment_duration' => 'required|integer|min:1'
        ]);

        $doctorSchedule->update($validated);

        return redirect()->route('doctor.schedules.index')
            ->with('success', __('Schedule updated successfully'));
    }

    public function destroy(DoctorSchedule $doctorSchedule)
    {
        $doctorSchedule->delete();

        return redirect()->route('doctor.schedules.index')
            ->with('success', __('Schedule deleted successfully'));
    }

    public function show(DoctorSchedule $doctorSchedule)
    {
        $schedule = $doctorSchedule->load([
            'doctor' => function($query) {
                $query->select('id', 'name', 'email', 'phone');
            },
            'appointments' => function($query) {
                $query->with(['patient' => function($q) {
                    $q->select('id', 'name', 'email', 'phone');
                }])
                ->select('id', 'schedule_id', 'patient_id', 'doctor_id', 'date', 'start_time', 'end_time', 'status', 'notes')
                ->orderBy('date')
                ->orderBy('start_time');
            }
        ]);
        dd($schedule);
        if (!$schedule->doctor) {
            return redirect()->route('doctor.schedules.index')
                ->with('error', __('Schedule information not found'));
        }

        return view('dashboard.doctor-schedules.show', compact('schedule'));
    }
}