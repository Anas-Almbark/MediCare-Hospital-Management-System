<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Doctor extends Model
{
    use HasFactory, HasRoles;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function specialization(){
        return $this->belongsTo(Specialization::class);
    }
    protected $fillable = [
        'doctor',
        'specialization_id',
        'license_number',
        'experience_years',
    ];
    
}
