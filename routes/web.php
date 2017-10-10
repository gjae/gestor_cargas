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


Auth::routes();

Route::group(['prefix' => 'account'], function(){
	Route::get('active', 'usuarios\Account@active');
	Route::post('active_save', 'usuarios\Account@activar');
});

Route::get('/', function(){
	if(Auth::check()){
		return redirect()->to(url('dashboard'));
	}
	return redirect()->to( url('login') );
});
Route::group(['prefix' => 'dashboard', 'middleware' =>'auth' ], function(){
	
	Route::match(['get', 'post'],'/{modulo?}/{programa?}/{accion?}/{slug?}', 'Dashboard@index');

});
