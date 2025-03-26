<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'schedule_id',
        'date',
        'start_time',
        'end_time',
        'status',
        'notes'
    ];

    // العلاقة مع جدول المواعيد
    public function schedule()
    {
        return $this->belongsTo(DoctorSchedule::class, 'schedule_id');
    }

    // العلاقة مع المريض
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    // العلاقة مع الطبيب
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
