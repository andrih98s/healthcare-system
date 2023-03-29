<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Doctor extends Authenticatable
{
    use HasFactory;
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['photo', 'full_name','n_number','job_description','Job_ID',
    'date_of_birth','years_of_experience','phone_number',
    'email','email','password','address',
    'gender','nationality','about','Doctor_rate','admin_id'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }
    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }
    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'doctor_patient');
    }
    public function report()
    {
        return $this->hasMany(Report::class);
    }
    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
