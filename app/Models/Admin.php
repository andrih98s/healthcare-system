<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable

{
    use HasFactory;
    use HasApiTokens;
   use Notifiable;

    protected $fillable=['full_name', 'email',  
    'password', 'phone_number' ,'is_reception', 'is_analyzer' ,'is_supervisor'];





    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
    public function appointment()
    {
        return $this->hasMany(Patient::class);
    }
    public function report()
    {
        return $this->hasMany(Report::class);
    }
    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
    public function medicalCenters()
    {
        return $this->belongsToMany(MedicalCenter::class, 'admins_medical_centers');
    }
}
