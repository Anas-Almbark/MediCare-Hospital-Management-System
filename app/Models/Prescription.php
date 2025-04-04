<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'description',
        'appointment_id'
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function labTest()
    {
        return $this->hasOne(LabTest::class, 'prescription_id');
    }

    public function getLabResultFileAttribute()
    {
        if ($this->labTest && $this->labTest->result) {
            return storage_path('app/public/' . $this->labTest->result);
        }
        return null;
    }
}
