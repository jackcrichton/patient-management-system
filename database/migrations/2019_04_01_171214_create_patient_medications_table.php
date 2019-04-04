<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_medications', function (Blueprint $table) {
            $table->increments('id');
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
        Schema::dropIfExists('patient_medications');
    }
}
