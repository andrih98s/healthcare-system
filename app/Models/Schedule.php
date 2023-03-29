<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable=['start_time','end_time','date','doctor_id'];



    public function doctors()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
