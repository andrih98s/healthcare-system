<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;
class DoctorAuthController extends Controller
{
    public function register(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|image|max:2048',
            'full_name' => 'required|string|max:255',
            'n_number' => 'required|string|max:255|unique:doctors,n_number',
            'job_description' => 'required|string|max:255',
            'Job_ID' => 'required|max:255',
            'date_of_birth' => 'required|date|before_or_equal:today',
            'years_of_experience' => 'required|integer|min:0|max:100',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email|max:255',
            'password' => 'required|string|min:8|max:255',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'nationality' => 'required|string|max:255',
            'about' => 'nullable|string',
            'Doctor_rate' => 'nullable|numeric|min:0|max:5',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $admin = Admin::find($id);

        $doctor = new Doctor();
        $doctor->full_name = $request->input('full_name');
        $doctor->date_of_birth = $request->input('date_of_birth');
        $doctor->n_number = $request->input('n_number');
        $doctor->phone_number = $request->input('phone_number');
        $doctor->email = $request->input('email');
        $doctor->password = Hash::make($request->input('password'));
        $doctor->address = $request->input('address');
        $doctor->years_of_experience = $request->input('years_of_experience');
        $doctor->job_description = $request->input('job_description');
        $doctor->Job_ID = $request->input('Job_ID');
        $doctor->gender = $request->input('gender');
        $doctor->nationality = $request->input('nationality');
        $doctor->about = $request->input('about');
        $doctor->doctor_rate = $request->input('doctor_rate');
        $doctor->admin_id = $admin->id;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/doctor_photos', $filename);
            $doctor->photo = asset('storage/doctor_photos/' . $filename);
        }

        $doctor->save();

        $token = $doctor->createToken('auth_token')->plainTextToken;

        return response()->json([
            'doctor' => $doctor,
            'photo_url' => $doctor->photo,
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

        $doctor = Doctor::where('email', $request->email)->first();

        if (!$doctor || !Hash::check($request->password, $doctor->password)) {
            return response()->json([
                'message' => 'Invalid login credentials',
            ], 401);
        }

        $token = $doctor->createToken('auth_token')->plainTextToken;

        return response()->json([
            'doctor' => $doctor,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function Doctor_by_id($id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        return response()->json($doctor, 201);
    }
    public function All_doctors()
    {
        $doctors = Doctor::all();
        if (!$doctors) {
            return response()->json(['message' => 'there is no doctor yet'], 404);
        }
        return response()->json($doctors);
    }
    public function delete_doctor($id)
    {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }
        $doctor->delete();
        return response()->json(['message' => 'Doctor deleted']);
    }
    public function count()
    {
        $count = Doctor::count();
        return response()->json(['count' => $count]);
    }
    public function createWorkingSchedule(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        // Create a new working schedule for the doctor
        $workingSchedule = new Schedule();
        // $admin = Admin::find($id);
        $workingSchedule->start_time = $validatedData['start_time'];
        $workingSchedule->end_time = $validatedData['end_time'];
        $workingSchedule->date = $validatedData['date'];
        $workingSchedule->doctor = $doctor->id;
        $workingSchedule->save();

        return response()->json([
            'message' => 'Working schedule created successfully',
            'workingSchedule' => $workingSchedule,
        ], 201);
    }
    public function WorkingSchedule_index(Doctor $doctor)
    {
        $workingSchedules = $doctor->schedule()->get();

        return response()->json($workingSchedules);
    }
    public function addPatient(Doctor $doctor, Request $request)
    {
        // define the validation rules
        $rules = [
            'patient_id' => 'required|exists:patients,id',
        ];

        try {
            // run the validation
            $validator = Validator::make($request->all(), $rules);

            // if the validation fails, throw an exception
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            // retrieve the patient with the given ID
            $patient = Patient::findOrFail($request->input('patient_id'));

            // attach the patient to the doctor's list of patients
            $doctor->patients()->attach($patient);

            // return a success response
            return response()->json([
                'message' => 'Patient added to doctor successfully.'
            ]);
        } catch (Exception $e) {
            // if an exception occurs, return an error response
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }
    public function viewPatients($doctorId)
    {
        try {
            $doctor = Doctor::findOrFail($doctorId);
            $patients = $doctor->patients;
            if ($patients->isEmpty()) {
                return response()->json(['message' => 'Doctor does not have any patients yet.']);
            }
    
            return response()->json(['patients' => $patients]);
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }
    public function deletePatient($doctorId, $patientId)
    {
        $validator = Validator::make(
            ['doctor_id' => $doctorId, 'patient_id' => $patientId],
            ['doctor_id' => 'required|integer|exists:doctors,id', 'patient_id' => 'required|integer|exists:patients,id']
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        $doctor = Doctor::find($doctorId);
        $patient = Patient::find($patientId);

        if (!$doctor->patients()->find($patientId)) {
            return response()->json(['message' => 'Patient does not belong to this doctor.'], 422);
        }

        $doctor->patients()->detach($patientId);

        return response()->json(['message' => 'Patient removed from doctor successfully.']);
    }
    
}
