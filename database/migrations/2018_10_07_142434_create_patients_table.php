<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('forename');
            $table->string('surname');
            $table->date('dateOfBirth');
            $table->enum('sex', ['male', 'female', 'other']);
            $table->string('firstLineAddress');
            $table->string('town');
            $table->string('country');
            $table->string('postcode');
            $table->integer('mobileNo');
            $table->string('email')->nullable();
            $table->integer('userAssignedTo')->unsigned()->nullable();
            $table->foreign('userAssignedTo')->references('id')->on('users'); 
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
        Schema::dropIfExists('patients');
    }
}
