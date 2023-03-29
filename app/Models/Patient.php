<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Patient extends Authenticatable
{
    use HasFactory;
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'photo',
        'full_name',
        'date_of_birth',
        'n_number',
        'phone_number',
        'email',
        'password',
        'address',
        'height',
        'weight',
        'blood_type',
        'disease_name',
        'description_disease',
        'gender',
        'patient_rate',
        'file_no',
        'supervisor_id',
        'admin_id',
    ];

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
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_patient');
    }
    public function report()
    {
        return $this->hasMany(Report::class);
    }
    
}
