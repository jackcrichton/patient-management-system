<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientMedicalRecordLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_medical_record_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patientMedicationId')->unsigned();
            $table->foreign('patientMedicationId')->references('id')->on('patient_medications');
            $table->integer('doctorId')->unsigned();
            $table->foreign('doctorId')->references('id')->on('users');
            $table->enum('type', array('Create', 'Update', 'Delete'));
            $table->integer('patientId')->unsigned();
            $table->foreign('patientId')->references('id')->on('patients');
            $table->integer('medicationId')->unsigned();
            $table->foreign('medicationId')->references('id')->on('allergies');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('quantity');
            $table->text('notes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_medical_record_logs');
    }
}
