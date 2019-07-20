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
Route::post('login', 'PassportController@login');
Route::post('register', 'PassportController@register');


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
