<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'user_id',
        'response',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
