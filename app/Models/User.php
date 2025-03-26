<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'birth_date',
        'gender',
        'phone_number',
        'blood_type',
        'address',
        'identity_number',
        'provider_id',
        'provider_name',
        'token',
        'refresh_token',
        'status_account'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function scopeSearch($query, $request = '')
    {
        $query->where("name", "like", "%" . $request . "%");
    }
    public function scopeFilterByRole($query, $request = '')
    {
        return (!$request) ? $query :
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request);
            });
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id')->with(['doctor', 'schedule']);
    }

    public function doctorAppointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id')->with(['patient', 'schedule']);
    }

    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id')->with(['appointments.patient', 'appointments.doctor']);
    }
    public function labTests()
    {
        return $this->hasMany(LabTest::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function salaries()
    {
        return $this->hasMany(Salary::class, 'employee');
    }
    public function supports()
    {
        return $this->hasMany(Support::class);
    }
    public function staticSalary()
    {
        return $this->hasOne(StaticSalary::class, 'employee', 'id');
    }
    public static function employees()
    {
        return self::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['admin', 'super-admin']);
        })->get();
    }
    public static function notHaveSalaryThisMonth()
    {
        return self::whereDoesntHave('salaries', function ($query) {
            $query->whereMonth('payment_date', now()->month);
        })->whereIn('id', self::employees()->pluck('id'))->get();
    }
    public function specializations()
    {
        return $this->belongsToMany(Specialization::class, 'doctor_specialization', 'doctor_id', 'specialization_id');
    }
}
