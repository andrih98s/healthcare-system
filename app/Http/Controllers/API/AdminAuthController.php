<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
class AdminAuthController extends Controller
{
    public function addSchedule(Request $request, Admin $admin,$id)
    {      $doctor = Doctor::find($id);
        
        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }
        $schedule = $admin->schedule()->create([
            
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'date' => $request->input('date'),
            'doctor_id' => $id
        ]);

        return response()->json(['schedule' => $schedule]);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }
    
        $admin = Admin::where('email', $request->email)->first();
    
        if (!$admin) {
            return response()->json([
                'message' => 'Invalid login credentials',
            ], 401);
        }
    
        $token = $admin->createToken('auth_token')->plainTextToken;
    
        return response()->json([
            'admin' => $admin,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

}
