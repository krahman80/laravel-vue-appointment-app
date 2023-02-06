<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments() 
    {
        return $this->belongsToMany(User::class, 'appointments')->withPivot('status')->withTimestamps();
    }
}
