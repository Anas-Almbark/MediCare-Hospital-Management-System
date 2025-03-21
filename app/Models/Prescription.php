<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'doctor',
        'patient',
        'description',

    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient');
    }
}
