<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'patient',
        'doctor',
        'date',
        'notes',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor');
    }
}
