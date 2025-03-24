<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticSalary extends Model
{
    protected $fillable = [
        'employee',
        'salary',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee', 'id');
    }
}
