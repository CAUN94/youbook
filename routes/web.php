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

// Route::get('/','RedirectController@index');

// Route::get('/book','FrontendController@index');
Route::get('/','FrontendController@index');


Route::get('/dashboard','DashboardController@index');
Route::get('/calendar','DashboardController@calendar');
Route::get('/week','DashboardController@week');

Route::get('/training-new','TrainingController@trainingnew');
Route::get('/training-user','TrainingController@traininguser');
Route::post('/training-register_new','TrainingController@create_training_new')->name('training-register');
Route::post('/training-register_user','TrainingController@create_training_user')->name('training-register-user');
Route::get('/new-appoinment/{professionalId}/{date}','FrontendController@show')->name('create.appointment');



Auth::routes();

Route::get('/solicitud-desarrollo','RedirectController@development');
Route::get('/solicitud-comunicaciones','RedirectController@communications');
Route::get('/solicitud-administracion','RedirectController@administration');
Route::get('/youphone','RedirectController@whatsapp');
Route::get('/entrenamiento','RedirectController@trainning');
Route::get('/aranceles','RedirectController@arancel');
Route::get('/pago','RedirectController@pay');
Route::get('/rrhh','RedirectController@rrhh');
Route::get('/techosalud','RedirectController@techo');

Route::get('/box/dcontrerasb','RedirectController@contreras');
Route::get('/box/rbarchiesiv','RedirectController@barchiesi');
Route::get('/box/icristis','RedirectController@cristi');
Route::get('/box/jmguzmanh','RedirectController@guzman');
Route::get('/box/amaldonados','RedirectController@maldonado');
Route::get('/box/mjmartinezm','RedirectController@martinez');
Route::get('/box/cmoyac','RedirectController@moya');
Route::get('/box/aniklitscheks','RedirectController@niklitschek');
Route::get('/box/mrossg','RedirectController@ross');
Route::get('/box/cvalenzuelar','RedirectController@valenzuela');
Route::get('/box/dvivallov','RedirectController@vivallo');
Route::get('/box/internos','RedirectController@internos');
Route::get('/box/alopezm','RedirectController@lopez');
Route::get('/box/fguzmanh','RedirectController@fguzman');
Route::get('/box/chernandezc','RedirectController@hernandez');
Route::get('/box/svitalim','RedirectController@vitali');
Route::get('/box/meetyou','RedirectController@meetyou');

Route::group(['middleware'=>['auth','patient']],function(){
	Route::post('/book/appointment','FrontendController@store')->name('booking.appointment');
	Route::post('/book/appointment-store','FrontendController@storetrain')->name('booking.train');
	Route::delete('/book/appointment-delete','FrontendController@deletetrain')->name('delete.booking.train');
	Route::get('/my-booking','FrontendController@myBookings')->name('my.booking');
	Route::get('/training','TrainingController@index');
	Route::get('/profile','ProfileController@index');
	Route::post('/profile','ProfileController@store')->name('profile.store');
	Route::post('/profile-pic','ProfileController@profilePic')->name('profile.pic');
	Route::get('/my-record','FrontendController@myRecords')->name('my.record');
});


Route::group(['middleware'=>['auth','admin']], function(){
	Route::resource('professionals','ProfessionalController');
	Route::get('/patients','PatientlistController@index')->name('patient');
	Route::get('/patients/all','PatientlistController@allTimeAppointment')->name('all.appointments');
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

Route::group(['middleware'=>['auth','trainer']], function(){
	Route::get('/classes_today/{id}','AdminTrainingController@classes_today')->name('admin.training.today');
	Route::get('/students','AdminTrainingController@students')->name('admin.training.students');
	Route::get('/train_toogle/{student_id}/{book_id}','AdminTrainingController@toggleStatus')->name('admin.training.toogle');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
