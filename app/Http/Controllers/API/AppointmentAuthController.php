<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentAuthController extends Controller
{
    public function all_appointment()
    {
   
    $appointment = Appointment::all();
    if (!$appointment) {
        return response()->json(['message' => 'there is no appointment yet'], 404);
    }
    return response()->json($appointment);
    }
}
