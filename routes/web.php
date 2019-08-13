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


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/usuarios', 'PassportController@index')->name('usuarios');
Route::get('/usuarios/{post}/delete', 'PassportController@destroy')->name('eliminarusuario')->middleware('auth');     //DELETE


Route::get('/prospectos', 'Prospectos\ProspectosGuideController@index')->middleware('auth');
Route::get('/prospectos/{id}', 'Prospectos\ProspectosGuideController@show')->name('detallesprospecto')->middleware('auth');

Route::get('/prospectos/{post}/delete', 'Prospectos\ProspectosGuideController@destroy')->name('eliminarprospecto')->middleware('auth');     //DELETE
