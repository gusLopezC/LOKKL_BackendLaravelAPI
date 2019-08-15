<?php

use Illuminate\Http\Request;

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


Route::middleware('auth:api')->group(function () {

    /**
     * Users
     */
    Route::resource('users', 'PassportController');
    Route::post('users/perfil/foto', 'PassportController@updatePhoto')->name('users.updatePhoto');
    
    /**
     * Prospectos
     */
    Route::resource('prospectos', 'Prospectos\ProspectosGuideController');
    Route::post('users/perfil/documentGuide', 'Prospectos\ProspectosGuideController@updateDocument')->name('prospects.updateDocument');

    /**
     * Buyers
     */
    Route::resource('buyers', 'Buyer\BuyerController', ['only' => ['index', 'show']]);
    /**
     * Categories
     */
    Route::resource('categories', 'Category\CategoryController', ['except' => ['create', 'edit']]);
    /**
     * transaction
     */
    Route::resource('product', 'Product\ProductController', ['only' => ['index', 'show']]);
    /**
     * transaction
     */
    Route::resource('transactions', 'Transaction\TransactionController');
    /**
     * Seller
     */
    Route::resource('sellers', 'Seller\SellerController', ['only' => ['index', 'show']]);
});

     /**
     * Users
     */

     Route::resource('emails', 'Mail\EmailController');
     Route::post('emailContacto', 'Mail\EmailController@EmailContact');
     Route::get('/send/email', 'HomeController@mail');
     Route::get('users/verify/{token}', 'PassportController@verify')->name('users.verify');
     Route::get('users/{user}/resend', 'PassportController@resend')->name('users.resend');