<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'WelcomeController@index')->name('welcome');

Route::group(['namespace' => 'Admin', 'middleware' => ['isAdmin', 'auth']], function() {
	Route::resource('admin', 'AdminController')->middleware('isAdmin');
	Route::resource('doctor', 'DoctorController')->middleware('isAdmin');
});

Route::group(['middleware' => ['isDoctor', 'auth']], function() {   
	Route::resource('patient', 'PatientController')->middleware('isDoctor');		  
	Route::resource('patient-allergies', 'PatientAllergyController')->middleware('isDoctor');	  
	Route::resource('patient-medication', 'PatientMedicationController')->middleware('isDoctor');
	Route::resource('patient-history', 'PatientHistoryController')->middleware('isDoctor');		  
});

Route::group(['namespace' => 'Receptionist', 'middleware' => ['isReceptionist', 'auth']], function() {
	Route::resource('receptionist', 'ReceptionistController')->middleware('isReceptionist');		   	
});
