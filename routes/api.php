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


Route::resource('tours', 'Tours\ToursController');


Route::middleware('auth:api')->group(function () {

    /**
     * Users
     */
    Route::resource('users', 'PassportController');
    Route::post('users/perfil/foto', 'PassportController@updatePhoto')->name('users.updatePhoto');
    Route::post('users/perfil/changepassword', 'PassportController@changePassword')->name('users.changePassword');
    Route::post('users/refreshProfile', 'PassportController@refreshUser')->name('users.refreshProfile');

    /**
     * Prospectos
     */
    Route::resource('prospectos', 'Prospectos\ProspectosGuideController');
    Route::post('users/perfil/documentGuide', 'Prospectos\ProspectosGuideController@updateDocument')->name('prospects.updateDocument');

    /**
     * Guias
     */
    Route::resource('guias', 'Guias\GuiasController');
    Route::post('guias/datosPago', 'Guias\GuiasController@datosPagos')->name('datosPago.datosPagos');

    /**
     * Tours
     */
    Route::post('tours/obtenerporcuidad', 'Tours\ToursController@Obtenerporcuidad')->name('tours.obtenerporcuidad');

    /**
    * Tours
     */
    Route::resource('comentarios', 'Tours\ComentariosController');
    /**
     * transaction
     */
    Route::resource('transactions', 'Transaction\TransactionController');
});

/**
 * Users
 */

Route::resource('emails', 'Mail\EmailController');
Route::post('emailContacto', 'Mail\EmailController@EmailContact');
Route::get('/send/email', 'HomeController@mail');
Route::get('users/verify/{token}', 'PassportController@verify')->name('users.verify');
Route::get('users/{user}/resend', 'PassportController@resend')->name('users.resend');
