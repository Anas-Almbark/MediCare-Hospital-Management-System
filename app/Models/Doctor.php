<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Doctor extends Model
{
    use HasFactory, HasRoles;
    protected $fillable = [
        'id', 
        'specialization_id',
        'license_number',
        'experience_years'
    ];
    public function schedules()
{
    return $this->hasMany(DoctorSchedule::class);
}
    public function availableAppointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id')
                    ->where('status', 'available')
                    ->where('date', '>=', now())
                    ->orderBy('date')
                    ->orderBy('start_time');  // تم تغيير 'time' إلى 'start_time'
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }
}
