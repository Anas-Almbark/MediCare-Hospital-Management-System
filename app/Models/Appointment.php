<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Prescription;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'user_id',
        'status',
        'date',
        'start_time',
        'notes'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'doctor');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function prescription()
    {
        return $this->hasOne(Prescription::class);
    }
}
