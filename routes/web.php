<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','FrontendController@index');
Route::get('/dashboard','DashboardController@index');
Route::get('/calendar','DashboardController@calendar');
Route::get('/new-appoinment/{professionalId}/{date}','FrontendController@show')->name('create.appointment');
Auth::routes();

Route::get('/solicitud-desarrollo','RedirectController@development');
Route::get('/solicitud-comunicaciones','RedirectController@communications');
Route::get('/solicitud-administracion','RedirectController@administration');

Route::group(['middleware'=>['auth','patient']],function(){
	Route::post('/book/appointment','FrontendController@store')->name('booking.appointment');
	Route::get('/my-booking','FrontendController@myBookings')->name('my.booking');

	Route::get('/profile','ProfileController@index');
	Route::post('/profile','ProfileController@store')->name('profile.store');
	Route::post('/profile-pic','ProfileController@profilePic')->name('profile.pic');
	Route::get('/my-record','FrontendController@myRecords')->name('my.record');
});


Route::group(['middleware'=>['auth','admin']], function(){
	Route::resource('professionals','ProfessionalController');
	// Route::get('/patients','PatientlistController@index')->name('patient');
	// Route::get('/patients/all','PatientlistController@allTimeAppointment')->name('all.appointments');
	Route::get('/status/update/{id}','PatientlistController@toggleStatus')->name('update.status');
});

Route::group(['middleware'=>['auth','professional']], function(){


	Route::resource('appointments','AppointmentController');

	Route::get('/patients','PatientlistController@index')->name('patient');
	Route::get('/patients/all','PatientlistController@allTimeAppointment')->name('all.appointments');
	Route::get('/status/update/{id}','PatientlistController@toggleStatus')->name('update.status');
	Route::post('/appointments/check','AppointmentController@check')->name('appointments.check');
	Route::post('/appointment/update','AppointmentController@updateTime')->name('update');

	Route::get('/patient-today','RecordController@index')->name('patient.today');
	Route::get('/record/','RecordController@index')->name('record.index');
	Route::post('/record','RecordController@store')->name('record');
	Route::get('/record/{userId}/{date}','RecordController@show')->name('record.show');
	Route::get('/recorded-patients','RecordController@patientsFromRecord')->name('record.patients');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
