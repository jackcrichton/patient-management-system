vis<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //DOCTOR
        Schema::create('visitor_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('doctorId')->unsigned();
            $table->foreign('doctorId')->references('id')->on('users')->where('account_type', 'doctor');
            $table->integer('patientId')->unsigned();
            $table->foreign('patientId')->references('id')->on('patients');
            $table->integer('appointmentId')->unsigned()->nullable();
            $table->foreign('appointmentId')->references('id')->on('appointments');
            $table->dateTime('entryTime');
            $table->dateTime('leaveTime');
            $table->text('visitReason');
            $table->text('comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
