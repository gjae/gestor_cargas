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

Route::group(['prefix' => 'user'], function(){

    Route::post('login', 'usuarios\Account@login');
    Route::get('logout', 'usuarios\Account@logout');

    Route::group([ 'middleware' => 'auth:api' ], function(){
        Route::get('me', 'usuarios\Account@me');
        Route::get('session_active', 'usuarios\Account@check');
        Route::post('update', 'usuarios\Usuarios@edit');
    });

});

Route::group(['prefix' => 'publishers', 'middleware' => 'auth:api'], function(){

    Route::get('/categories', 'publicaciones\Publicaciones@categories');
    Route::get('/all', 'publicaciones\Publicaciones@index');
});