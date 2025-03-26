<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\LabType;

class LabTest extends Model
{
    protected $fillable = [
        'patient',
        'doctor',
        'lab_type_id',
        'result',
        'status',
    ];

    public function patientData()
    {
        return $this->belongsTo(User::class, 'patient');
    }

    public function doctorData()
    {
        return $this->belongsTo(User::class, 'doctor');
    }

    public function labType()
    {
        return $this->belongsTo(LabType::class);
    }
}
