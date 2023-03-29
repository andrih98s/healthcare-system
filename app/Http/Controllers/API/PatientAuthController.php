<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PatientAuthController extends Controller
{
    public function register(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|image',
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date_format:Y-m-d',
            'n_number' => 'required|string|max:20|unique:patients,n_number',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|unique:patients,email',
            'password' => 'required|string|min:8',
            'address' => 'required|string|max:255',
            'height' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'blood_type' => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'disease_name' => 'nullable|string|max:255',
            'description_disease' => 'nullable|string|max:255',
            'file_no' => 'required|unique:patients,file_no',
            'gender' => 'required|in:male,female',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $admin = Admin::find($id);
        
        $patient = new Patient;
        $patient->full_name = $request->input('full_name');
        $patient->date_of_birth = $request->input('date_of_birth');
        $patient->n_number = $request->input('n_number');
        $patient->phone_number = $request->input('phone_number');
        $patient->email = $request->input('email');
        $patient->password = Hash::make($request->input('password'));
        $patient->address = $request->input('address');
        $patient->height = $request->input('height');
        $patient->weight = $request->input('weight');
        $patient->blood_type = $request->input('blood_type');
        $patient->disease_name = $request->input('disease_name');
        $patient->description_disease = $request->input('description_disease');
        $patient->file_no = $request->input('file_no');
        $patient->gender = $request->input('gender');
        $patient->admin_id = $admin->id;
        
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/patient_photos', $filename);
            $patient->photo = asset('storage/patient_photos/' . $filename);
        }
        
        $patient->save();
        
        $token = $patient->createToken('auth_token')->plainTextToken;
        
        return response()->json([
            'patient' => $patient,
            'photo_url' => $patient->photo,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
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

        $patient = Patient::where('email', $request->email)->first();

        if (!$patient || !Hash::check($request->password, $patient->password)) {
            return response()->json([
                'message' => 'Invalid login credentials',
            ], 401);
        }

        $token = $patient->createToken('auth_token')->plainTextToken;

        return response()->json([
            'patient' => $patient,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function count()
    {
        $count = Patient::count();
        return response()->json(['count' => $count]);
    }
}
