<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = [
        'patient', 'doctor', 'diagnosis', 'prescription_id',
        'patient_id',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor');
    }
}
