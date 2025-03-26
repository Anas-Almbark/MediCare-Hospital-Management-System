<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    protected $fillable = [
        'doctor_id',
        'day_of_week',
        'date',
        'start_time',
        'end_time',
        'appointment_duration'
    ];

    // العلاقة مع الطبيب
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    // العلاقة مع المواعيد
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'schedule_id');
    }
}
