<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function 
            (Blueprint $table) {
            $table->increments('id');
            $table->enum('title', ['Dr', 'Mr', 'Mrs', 'Miss', 'Ms']);
            $table->string('forename');
            $table->string('surname');
            $table->string('email')->unique();
            $table->date('dateOfBirth');
            $table->string('password');
            $table->boolean('active');
            $table->enum('role', ['superadmin', 'admin', 'doctor', 'nurse', 'receptionist']);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
