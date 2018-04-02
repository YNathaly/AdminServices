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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/*Servicios*/
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/services','services\ServiceController@index')->name('services');
Route::post('/services','services\ServiceController@store')->name('services');
Route::get('/Listservices','services\ServiceController@show')->name('listservices');
Route::post('/delete_service','services\ServiceController@delete')->name('delete_service');
Route::post('/datos_service','services\ServiceController@showId')->name('datos_service');
Route::post('/updateservices','services\ServiceController@update')->name('updateservices');

/* Asignar responsables*/
Route::get('/Asignar','services\ServiceController@asignar')->name('asignar');
Route::post('/Asignar','services\ServiceController@storeRel')->name('asignar');
Route::get('/listado_resp','services\ServiceController@showRel')->name('listado_resp');
Route::post('/delete_serviceRel','services\ServiceController@deleteRel')->name('delete_serviceRel');


/*Solicitar servicios*/
Route::get('/solicitarServicio','services\RequestController@index')->name('requestservice');
Route::post('/solicitarServicio','services\RequestController@store')->name('requestServicio');
Route::get('/Listserv_solicitados','services\RequestController@show')->name('listservice');
Route::get('/service_id/{id}','services\RequestController@show_id')->name('service_id');
Route::post('/service_id/{id}','services\RequestController@storeSeguimiento')->name('storeSeguimiento');

/*Eventos*/
Route::get('/eventos','events\EventsController@index')->name('events');
Route::post('/eventos','events\EventsController@store')->name('events');
Route::get('/Listeventos','events\EventsController@show')->name('listevents');
Route::get('/evento_id/{id}','events\EventsController@show_id')->name('evento_id');
Route::post('/evento_id/{id}','events\EventsController@storeSeguimiento')->name('evento_id');

/*Tarea asignadas*/
Route::get('/listTags','tareas\tagsController@index')->name('listTags');


Route::get('/', function () {
    return view('auth.login');
});


