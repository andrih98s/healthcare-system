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
        Schema::create('samples', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lab_id');
            $table->unsignedBigInteger('medical_center_id');
            $table->string('sending_doctor_name');
            $table->string('patient_name');
            $table->unsignedBigInteger('patient_file_number');
            $table->string('patient_nationality');
            ///the result is :
            $table->string('res_doctor_name')->nullable();
            $table->string('res_patient_name')->nullable();
            $table->unsignedBigInteger('res_patient_file_number')->nullable();
            $table->string('res_patient_nationality')->nullable();
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
            $table->foreign('medical_center_id')->references('id')->on('medical_centers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('samples');
    }
};
