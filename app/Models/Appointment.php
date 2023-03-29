<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;


    public function doctors()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function patients()
    {
        return $this->belongsTo(Patient::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
