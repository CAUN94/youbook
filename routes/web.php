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
Route::get('/padpow','PadpowController@pay');
Route::get('/padpow/{code}/return_url','PadpowController@code');


Route::get('/training-new','TrainingController@trainingnew');
Route::get('/training-user','TrainingController@traininguser');
Route::delete('/training','TrainingController@delete');
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
	Route::post('/book/appointment','FrontendController@store')->name('fng.appointment');
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
	Route::delete('/students/{id}', 'StudentController@destroy');
	Route::put('/studentsSettled/{id}', 'StudentController@settled');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// YouApp

Route::get('/youapp', 'HomeController@youapp')->name('youapp');
Route::get('/pdf/{id}', 'PDFController@download')->name('permiso');
Route::get('/training-resume','TrainingController@training')->name('training-resume');

Route::get('/you-wsp', 'HomeController@panel')->name('you-wsp');
Route::get('/excel', 'HomeController@excel')->name('excel');
Route::get('/you-wsp/tomorrow', 'HomeController@tomorrow')->name('tomorrow');
Route::get('/you-wsp/today', 'HomeController@today')->name('today');
Route::get('/you-wsp/training', 'HomeController@training')->name('training-wsp');
Route::get('/canceled', 'HomeController@canceled')->name('canceled');
Route::get('/excel', 'HomeController@excel')->name('excel');
Route::get('/general', 'HomeController@general')->name('general');
Route::get('/excel/ocuppation/{type}', 'ExcelController@occupation')->name('excel-download');
Route::get('/excel/professional', 'ExcelController@professionals')->name('excel-professionals');
Route::get('/excel/professional/{name}', 'ExcelController@professional')->name('excel-professional');
Route::get('/excel/team', 'ExcelController@team')->name('excel-team');

Route::get('/fintoc', 'FintocController@index')->name('fintoc');
Route::get('/transfers', 'TransfersController@index')->name('transfers');
Route::get('/agreement/history', 'AgreementController@history')->name('agreement-history');

Route::get('/scraping', 'ScrapingController@carbon');
Route::get('/scraping-appointments', 'ScrapingController@appointments')->name('scraping-appointments');
Route::get('/scraping-actions', 'ScrapingController@actions')->name('scraping-actions');
Route::get('/scraping-treatments', 'ScrapingController@treatments')->name('scraping-treatments');
Route::get('/scraping-payments', 'ScrapingController@payments')->name('scraping-payments');
Route::get('/professional', 'ProfessionalAppController@index')->name('professional.index');
Route::get('/professional/{name}', 'ProfessionalAppController@show')->name('professional.show');

Route::get('/team', 'TeamController@index')->name('team.index');

Route::get('/weekreport', 'WeekController@index')->name('week.index');
Route::post('/weekreport', 'WeekController@show')->name('form-week');


Route::get('/occupation/{type}', 'OccupationController@occupation')->name('occupation');
Route::post('/occupation', 'OccupationController@form')->name('form-occupation');
Route::get('/occupation-professional/{type}', 'OccupationController@occupationprofessional')->name('occupation-professional');
Route::post('/occupation-professional', 'OccupationController@formprofessional')->name('form-occupation-professional');
