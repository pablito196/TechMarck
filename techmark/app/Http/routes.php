<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::auth();

Route::get('/dashboard', 'HomeController@index');
Route::resource('perfil','HomeController');
Route::group(['prefix'=>'admin','middleware'=>['auth'],'namespace'=>'Admin'], function(){

    /* todo  referente a usuarios */
    Route::resource('usuario','UserController');

});
Route::group(['prefix'=>'almacen','middleware'=>['auth']/*,'namespace'=>'Almacen'*/], function(){

    /* todo  referente a usuarios */
    Route::resource('articulo','ArticuloController');

});
Route::get('/p',function(){
	echo \Hash::make("123123");
});

Route::group(['prefix'=>'ventas','middleware'=>['auth'],'namespace'=>'Clientes'], function(){

    /* todo  referente a usuarios */
    Route::resource('cliente','ClienteController');

});
