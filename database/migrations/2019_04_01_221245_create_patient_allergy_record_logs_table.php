<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientAllergyRecordLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_allergy_record_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patientAllergyId')->unsigned();
            $table->foreign('patientAllergyId')->references('id')->on('patient_allergies');
            $table->integer('doctorId')->unsigned();
            $table->foreign('doctorId')->references('id')->on('users');
            $table->enum('type', array('Create', 'Update', 'Delete'));
            $table->integer('patientId')->unsigned();
            $table->foreign('patientId')->references('id')->on('patients');
            $table->integer('allergyId')->unsigned();
            $table->foreign('allergyId')->references('id')->on('allergies');
            $table->enum('reactionSeverity', ['Mild', 'Moderate', 'Severe']);
            $table->string('reaction');
            $table->enum('sourceOfInfo', array('Practise reported', 'Patient reported', 'Allergy history', 'Transition of care/referral'));
            $table->enum('status', array('Active', 'Inactive', 'Resolved'));
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
        Schema::dropIfExists('patient_allergy_record_logs');
    }
}
