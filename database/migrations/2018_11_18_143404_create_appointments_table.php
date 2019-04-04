<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //RECEPTIONIST
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('doctorId')->unsigned();
            $table->foreign('doctorId')->references('id')->on('users')->where('account_type', 'doctor');
            $table->text('reasonForVisit');
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
        Schema::dropIfExists('appointments');
    }
}
