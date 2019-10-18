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

/**
 * Usuarios
 */
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/usuarios', 'PassportController@index')->name('usuarios');
Route::get('/usuarios/{post}/delete', 'PassportController@destroy')->name('eliminarusuario')->middleware('auth');     //DELETE
/**
 * Prospectos
 */

Route::get('/prospectos', 'Prospectos\ProspectosGuideController@index')->middleware('auth');
Route::get('/prospectos/{id}', 'Prospectos\ProspectosGuideController@show')->name('detallesprospecto')->middleware('auth');
Route::get('/prospectos/{post}/solicitarDocumentos', 'Mail\EmailController@SolicitarDocumentacionProspectos')->name('solicitarDocumentos')->middleware('auth');
Route::get('/prospectos/{post}/aceptarProspecto', 'Prospectos\ProspectosGuideController@AceptarProspecto')->name('aceptarProspecto')->middleware('auth');

Route::get('/prospectos/{post}/delete', 'Prospectos\ProspectosGuideController@destroy')->name('eliminarprospecto')->middleware('auth');     //DELETE
/**
 * Guias
 */

Route::get('/guias', 'Guias\GuiasController@index')->name('usuarios');
Route::get('/guias/{id}', 'Guias\GuiasController@show')->name('detallesguia')->middleware('auth');
Route::get('/guias/{post}/delete', 'Guias\GuiasController@destroy')->name('eliminarguia')->middleware('auth');     //DELETE

/**
 * Tours
 */
Route::get('/tours', 'Tours\ToursController@index')->name('tours');
Route::get('/tours/{id}', 'Tours\ToursController@MostrarDatoTour')->name('detallestours');
Route::get('/tours/{tour}/aceptarTour', 'Tours\ToursController@AceptarTour')->name('AceptarTour')->middleware('auth');
Route::get('/tours/{tour}/NegarTour', 'Tours\ToursController@NegarTour')->name('NegarTour')->middleware('auth');

Route::delete('photo/{photo}', 'Tours\PhotoTourController@destroy')->name('admin.photos.destroy');     //DELETE

/**
 * Transacciones
 */

Route::get('/pagos', 'Payment\PaymentController@index')->name('pagos.verpagos');
Route::post('/pagoStripe', 'Payment\PaymentController@pagoStripe')->name('pagos.pagoStripe');

/**
 * Reservaciones
 */
Route::get('/pagos', 'Reservas\ReservasController@index')->name('pagos.verpagos');

/**
 * Cancelaciones
 */
