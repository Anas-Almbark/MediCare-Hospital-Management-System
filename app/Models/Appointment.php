<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['doctor', 'patient', 'date', 'status', 'notes'];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient');
    }
}
