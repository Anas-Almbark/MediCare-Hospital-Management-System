<?php

namespace Database\Seeders;

use App\Models\DoctorSchedule;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DoctorScheduleSeeder extends Seeder
{
    public function run()
    {
        // Get all doctors
        $doctors = User::role('doctor')->get();
        
        foreach ($doctors as $doctor) {
            $schedules = $this->createSchedulesForDoctor($doctor->id);
            
            foreach ($schedules as $schedule) {
                // Create the schedule
                $doctorSchedule = DoctorSchedule::create($schedule);
                
                // Generate appointments for this schedule
                $this->generateAppointments($doctorSchedule);
            }
        }
    }

    private function createSchedulesForDoctor($doctorId)
    {
        // Define working days and shifts
        $workingDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday'];
        
        // Get next Monday's date and generate dates for the week
        $nextMonday = Carbon::now()->next('Monday');
        $dates = [
            'Monday' => $nextMonday->format('Y-m-d'),
            'Tuesday' => $nextMonday->copy()->addDay()->format('Y-m-d'),
            'Wednesday' => $nextMonday->copy()->addDays(2)->format('Y-m-d'),
            'Thursday' => $nextMonday->copy()->addDays(3)->format('Y-m-d')
        ];

        $shifts = [
            [
                'start' => '09:00',
                'end' => '13:00',
                'duration' => 30 // 30 minutes per appointment
            ],
            [
                'start' => '16:00',
                'end' => '20:00',
                'duration' => 30
            ]
        ];

        $schedules = [];
        foreach ($workingDays as $day) {
            foreach ($shifts as $shift) {
                $schedules[] = [
                    'doctor_id' => $doctorId,
                    'day_of_week' => $day,
                    'date' => $dates[$day],
                    'start_time' => $shift['start'],
                    'end_time' => $shift['end'],
                    'appointment_duration' => $shift['duration']
                ];
            }
        }

        return $schedules;
    }

    private function generateAppointments($schedule)
    {
        $startTime = Carbon::parse($schedule->start_time);
        $endTime = Carbon::parse($schedule->end_time);
        $duration = $schedule->appointment_duration;

        while ($startTime->copy()->addMinutes($duration) <= $endTime) {
            Appointment::create([
                'doctor_id' => $schedule->doctor_id,
                'schedule_id' => $schedule->id,
                'day_of_week' => $schedule->day_of_week,
                'date' => $schedule->date,
                'start_time' => $startTime->format('H:i:s'),
                'end_time' => $startTime->copy()->addMinutes($duration)->format('H:i:s'),
                'status' => 'available',
                'notes' => null
            ]);

            $startTime->addMinutes($duration);
        }
    }
}