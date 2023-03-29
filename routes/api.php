<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\API\AdminAuthController;
use App\Http\Controllers\API\AppointmentAuthController;
use App\Http\Controllers\API\DoctorAuthController;
use App\Http\Controllers\API\PatientAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); //patients

Route::post('patients/login', [PatientAuthController::class, 'login']);

Route::post('doctors/login', [DoctorAuthController::class, 'login']);

Route::post('admins/login', [AdminAuthController::class, 'login']);

Route::post('/doctors/{doctor}/patients', [DoctorAuthController::class, 'addPatient']);//
Route::get('/doctors/{doctorId}/patients', [DoctorAuthController::class, 'viewPatients']);
Route::delete('/doctors/{doctorId}/patients/{patientId}', [DoctorAuthController::class, 'deletePatient']);

Route::get('test', function () {
    return 'It\'s working!';
});
Route::middleware('auth:sanctum')->group(function () {
    //doctors
    Route::get('doctors', [DoctorAuthController::class, 'All_doctors']);
    Route::delete('doctors/{id}', [DoctorAuthController::class, 'delete_doctor']);
    Route::post('doctors/register/{id}', [DoctorAuthController::class, 'register']);
    Route::get('doctors/{id}', [DoctorAuthController::class, 'Doctor_by_id']);
    Route::post('doctors/count', [DoctorAuthController::class, 'count']);
    //patients
    Route::post('patients/count', [PatientAuthController::class, 'count']);
    Route::post('patients/register/{id}', [PatientAuthController::class, 'register']);
    //appointment
    Route::get('appointments', [AppointmentAuthController::class, 'all_appointment']);
    //schedule
    Route::get('/doctors/{doctor}/WorkingSchedule_index', [DoctorAuthController::class, 'WorkingSchedule_index']);
    Route::post('/doctors/{id}/working-schedules', [DoctorAuthController::class, 'createWorkingSchedule']);
    //Admin
    Route::post('/admin/{admin}/schedules/{id}', [AdminAuthController::class, 'addSchedule']);
});
