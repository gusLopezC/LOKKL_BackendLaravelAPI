<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

/**
 * User
 * Route::resource('users', 'User\UserController', ['except' => ['create', 'edit']]);
 */
Route::get('prueba', 'PassportController@prueba');
Route::post('login', 'PassportController@login');
Route::post('register', 'PassportController@register');
Route::post('LoginGoogle', 'PassportController@LoginGoogle');


Route::post('password/create', 'User\PasswordResetController@create');
Route::get('password/find/{token}', 'User\PasswordResetController@find');
Route::post('password/reset', 'User\PasswordResetController@reset');

/**
 * Emails
 */

Route::resource('emails', 'Mail\EmailController');
Route::post('emailContacto', 'Mail\EmailController@EmailContact');
Route::get('/send/email', 'HomeController@mail');
Route::get('users/verify/{token}', 'PassportController@verify')->name('users.verify');
Route::get('users/{user}/resend', 'PassportController@resend')->name('users.resend');

/**
 * UsuarioPublico
 */
Route::get('users/perfil/perfilpublico/{id}', 'PassportController@ObtenerPerfilPublico')->name('users.ObtenerPerfilPublico');


/**
 * Tours
 */
Route::get('tours/ObtenerPorCiudad/{ciudad}', 'Tours\ToursController@ObtenerPorCiudad')->name('tours.ObtenerPorCiudad');
Route::get('tours/ObtenerTour/{slug}', 'Tours\ToursController@ObtenerTour')->name('tours.ObtenerTour');

Route::resource('tour/comentarios', 'Tours\ComentariosController');


/**
 * ToursPorCiudad
 */
Route::get('tours/ObtenerToursNuevos', 'Tours\ToursCiudad\ToursCiudad@ObtenerToursNuevos')->name('tours.ObtenerToursNuevos');
Route::get('tours/ObtenerToursCiudad/{ciudad}', 'Tours\ToursCiudad\ToursCiudad@ObtenerToursCiudad')->name('tours.ObtenerToursCiudad');

Route::get('tours/ObtenerTourInfiniteScroll', 'Tours\ToursCiudad\ToursCiudad@ObtenerTourInfiniteScroll')->name('tours.ObtenerTourInfiniteScroll');


Route::get('reservaciones/obtenertourRealizado', 'Reservas\ReservasController@obtenertourRealizado');

/**
 * Rutas protegidas por autentificacion
 */

Route::middleware('auth:api')->group(function () {

    /**
     * Users
     */
    Route::resource('users', 'PassportController');
    Route::post('users/perfil/foto', 'PassportController@updatePhoto')->name('users.updatePhoto');
    Route::post('users/perfil/changepassword', 'PassportController@changePassword')->name('users.changePassword');
    Route::post('users/refreshProfile', 'PassportController@refreshUser')->name('users.refreshProfile');


    Route::resource('users/contactoEmergencia', 'DatosPersonales\UserDatosPersonalesController');
    Route::post('users/guardarcontactoEmergencia', 'DatosPersonales\UserDatosPersonalesController@guardarInfoPersonal');
    Route::post('users/archivovalidacion', 'DatosPersonales\UserDatosPersonalesController@updatePhotoValidacion');


    /**
     * Prospectos
     */
    Route::resource('prospectos', 'Prospectos\ProspectosGuideController');
    Route::post('prospectosEmpresa', 'Prospectos\ProspectosGuideController@registrarProspectoEmpresa')->name('prospects.registrarProspectoEmpresa');
    Route::post('users/perfil/documentGuide', 'Prospectos\ProspectosGuideController@updateDocument')->name('prospects.updateDocument');
    Route::get('users/prospectos/prospectoRegistrado/{email}', 'Prospectos\ProspectosGuideController@prospectoRegistrado')->name('prospects.prospectoRegistrado');

    /**
     * Guias
     */
    Route::resource('guias', 'Guias\GuiasController');
    Route::post('guias/datosPago', 'Guias\GuiasController@datosPagos')->name('datosPago.datosPagos');
    Route::get('guias/datosPago/{id}', 'Guias\GuiasController@obtenerMisDatosPago')->name('datosPago.obtenerMisDatosPago');

    /**
     * Tours
     */
    Route::resource('tours', 'Tours\ToursController');
    Route::post('tours/uploadFiles/{id}', 'Tours\ToursController@uploadFiles')->name('tours.uploadFiles');
    Route::get('tours/misTours/{id}', 'Tours\ToursController@ObtenerMisTours')->name('tours.ObtenerMisTours');
    Route::post('tours/editTours', 'Tours\ToursController@EditarTours')->name('tours.EditarTours');

    Route::delete('tours/borrarFotoTour/{id}', 'Tours\PhotoTourController@destroyPhotoApi')->name('tours.destroyPhotoApi');

    /**
     * Transaction
     */
    Route::post('transactions/paymentStripe', 'Payment\PaymentController@pagoStripeApi');
    Route::post('transactions/paymentPaypal', 'Payment\PaymentController@pagoPaypal');

    /**
     * transaction
     */
    Route::get('reservaciones/obtenerReservaciones/{id}', 'Reservas\ReservasController@obtenerReservaciones');
    Route::get('reservaciones/obtenerHistorialReservaciones/{id}', 'Reservas\ReservasController@obtenerHistorialReservaciones');
    Route::get('reservaciones/obtenerMisViajes/{id}', 'Reservas\ReservasController@obtenerMisViajes');
    Route::get('reservaciones/obtenerHistorialMisViajes/{id}', 'Reservas\ReservasController@obtenerHistorialMisViajes');
    Route::get('reservaciones/obtenerReservacionesCalendario/{id}', 'Reservas\ReservasController@obtenerReservacionesCalendario');

    Route::post('reservaciones/aceptarTour', 'Reservas\ReservasController@aceptarTour');
    Route::post('reservaciones/cancelarReservacionCliente', 'Cancelations\CancelationsController@cancelarReservacionCliente');
    Route::post('reservaciones/cancelarReservacionGuia', 'Cancelations\CancelationsController@cancelarReservacionGuia');

    Route::get('reservaciones/obtenerDiferenciasDias/{order}', 'Cancelations\CancelationsController@obtenerDiferenciasDias');
});
