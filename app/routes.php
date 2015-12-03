<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('role', 'Role');
Route::model('orden', 'Orden', function()
{
    throw new NotFoundHttpException;
});
Route::model('sucursales', 'Sucursales', function()
{
    throw new NotFoundHttpException;
});
/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');
Route::pattern('sucursales', '[0-9]+');

# Index Page -login
Route::get('/', array('uses' => 'HomeController@getIndex'));


/** ------------------------------------------
 *  group Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'dashboard', 'before' => 'auth'), function()
{
	Route::get('home', 			array('as' => 'home', 'uses' =>  'HomeController@getHome'));
	 
	Route::post("imagen",		array('as' => "subirImagen", 'uses' => 'UserController@subirImagen'));
	 
	//************ Sucursales  ***************************************************
    Route::get('sucursales/',                          array( 'as' => 'see.sucursales',         'uses' =>'SucursalesController@index'));
    Route::get('sucursales/create',                    array( 'as' => 'create.sucursales',      'uses' =>'SucursalesController@create'));
    Route::post('sucursales/post/create',              array( 'as' => 'post.create.sucursales', 'uses' =>'SucursalesController@store'));
    Route::get('sucursales/edit/{sucursales}',         array( 'as' => 'edit.sucursales',        'uses' =>'SucursalesController@edit'));
    Route::post('sucursales/{sucursales}/edit',        array( 'as' => 'post.edit.sucursales',   'uses' =>'SucursalesController@update'));
    Route::get('sucursales/delete/{sucursales}',       array( 'as' => 'delete.sucursales',      'uses' =>'SucursalesController@destroy'));
    Route::controller('Sucursales', 'SucursalesController');
    //************ End Sucursales  ***************************************************

});


/** ------------------------------------------
 *  Frontend Routes USERS 
 *  ------------------------------------------
 */
Route::get('user/reset/{token}', 'UserController@getReset');// User reset routes
Route::post('user/reset/{token}', 'UserController@postReset');// User password reset
Route::post('user/{user}/edit', 'UserController@postEdit');//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');//:: User Account Routes ::
Route::controller('user', 'UserController');# User RESTful Routes (Login, Logout, Register, etc)


Route::get('excel/{orden}', 'PruebasController@getShowexcel');
Route::controller('Pruebas', 'PruebasController');
