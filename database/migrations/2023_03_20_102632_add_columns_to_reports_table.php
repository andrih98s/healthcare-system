<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            //AdmissionData
            $table->date('AdmissionDateandTime')->default(date('Y-m-d'));
            $table->string('Admission Diagnosis');
            $table->string('Admitting_THHC_Staff_Name_ID');
            $table->string('Physician');
            $table->string('Specialty');
            $table->string('Reason_for_THHC');
            $table->string('Information_obtained');
            //VITAL SIGNS
            $table->string('Temp');
            $table->string('Pulse Rate');
            $table->string('Respiration');
            $table->string('Oxygen Saturation');
            $table->string('Height');
            $table->string('Weight');
            $table->string('r_Arm');
            $table->string('r_Wrist');
            $table->string('r_Leg');
            $table->string('l_Arm');
            $table->string('l_Wrist');
            $table->string('l_Leg');
            $table->string('Blood Pressure');
            //PAIN ASSESSMENT
            $table->string('exhibit_of_Pain');
            $table->string('ALLERGIES');
            $table->string('Medication');
            $table->string('Food');
            $table->string('Other');
            //CONSENT
            $table->string('Signed');
            $table->string('Signed_By');
            //PATIENT BILL OF RIGHTS
            $table->string('Ptients_Copy');
            $table->string('ORIENTATION');
            //B . HEALTH HISTORY
            $table->string('HEALTH_PROBLEMS');
            $table->string('Previous_Hospitalization');
            $table->string('SLEEP/REST');
            $table->string('Sleep routine');
            $table->string('What_helps_sleep');
            $table->string('PSYCHOLOGICAL_ASSESSMENT');
            //GASTROINTESTINAL
            $table->string('Bowel Sounds');
            $table->string('ELIMINATION');
            $table->string('Abdomen');
            $table->string('General');
            $table->string('Tubes');
            //REPRODUCTIVE
            $table->string('REPRODUCTIVE');
            $table->string('MALE')->nullable();
            $table->string('Female')->nullable();
            $table->string('Breasts');
            $table->string('GENTOURINARY');
            $table->string('SKIN/INTEGUMENTARY');
            $table->string('NEUROLOGICAL');
            $table->string('GeneralN');
            $table->string('Level_consciousness');
            $table->string('Oriented_to');
            $table->string('Responsiveness');
            $table->string('CARDIOVASCULAR');
            $table->string('EENT_MOUTH');
            $table->string('ENDOCRINE/DIABETES');
            $table->string('SOCIO-ECONOMIC');
            $table->string('MUSCULOSKELETAL');
            $table->string('INFUSION_THERAPY');
            $table->string('EDUCATIONAL ASSESSMENT');
            $table->string('DISCHARGE');
            $table->string('ASSESSMENT_FINDING');
            $table->string('CARE_PROVIDED');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            //
        });
    }
};
