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
Route::model('unidades', 'Unidades', function()
{
    throw new NotFoundHttpException;
});
Route::model('materias', 'Materias', function()
{
    throw new NotFoundHttpException;
});

Route::model('platillos', 'Platillos', function()
{
    throw new NotFoundHttpException;
});

Route::model('platillosmp', 'Platillosmp', function()
{
    throw new NotFoundHttpException;
});

Route::model('pedidos', 'Pedidos', function()
{
    throw new NotFoundHttpException;
});
Route::model('pedidosplat', 'Pedidosplat', function()
{
    throw new NotFoundHttpException;
});
Route::model('empaques', 'Empaques', function()
{
    throw new NotFoundHttpException;
});
Route::model('empaquesmp', 'EmpaquesMp', function()
{
    throw new NotFoundHttpException;
});

Route::model('orden', 'Orden', function()
{
    throw new NotFoundHttpException;
});

Route::model('ordenpedido', 'Ordenpedido', function()
{
    throw new NotFoundHttpException;
});
Route::model('sucursales', 'Sucursales', function()
{
    throw new NotFoundHttpException;
});

Route::model('proveedores', 'Proveedores', function()
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
Route::pattern('unidades', '[0-9]+');
Route::pattern('proveedores', '[0-9]+');
Route::pattern('empaques', '[0-9]+');
Route::pattern('platillos', '[0-9]+');
Route::pattern('pedidos', '[0-9]+');
Route::pattern('pedidosplat', '[0-9]+');
Route::pattern('empaques', '[0-9]+');
Route::pattern('empaquesmp', '[0-9]+');
Route::pattern('orden', '[0-9]+');
Route::pattern('ordenpedido', '[0-9]+');
Route::pattern('sucursales', '[0-9]+');
Route::pattern('proveedores', '[0-9]+');

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

	 //************ Unidades  ***************************************************
    Route::get('unidades/',                          array( 'as' => 'see.unidades',             'uses' =>'UnidadesController@getIndex'));
    Route::get('unidades/create',                    array( 'as' => 'create.unidades',          'uses' =>'UnidadesController@getCreate'));
    Route::post('unidades/post/create',              array( 'as' => 'post.create.unidades',     'uses' =>'UnidadesController@postCreate'));
    Route::get('unidades/edit/{unidades}',           array( 'as' => 'edit.unidades',            'uses' =>'UnidadesController@getEdit'));
    Route::post('unidades/{unidades}/edit',          array( 'as' => 'post.edit.unidades',       'uses' =>'UnidadesController@postEdit'));
    Route::get('unidades/delete/{unidades}',         array( 'as' => 'delete.unidades',          'uses' =>'UnidadesController@getDelete'));
    Route::controller('Unidades', 'UnidadesController');
    //************ End Unidades  ***************************************************

   //************ Materia Prima  ***************************************************
    Route::get('materias/',                          array( 'as' => 'see.materias',             'uses' =>'MateriasController@getIndex'));
    Route::get('materias/create',                    array( 'as' => 'create.materias',          'uses' =>'MateriasController@getCreate'));
    Route::post('materias/post/create',              array( 'as' => 'post.create.materias',     'uses' =>'MateriasController@postCreate'));
    Route::get('materias/edit/{materias}',           array( 'as' => 'edit.materias',            'uses' =>'MateriasController@getEdit'));
    Route::post('materias/{materias}/edit',          array( 'as' => 'post.edit.unidades',       'uses' =>'MateriasController@postEdit'));
    Route::get('materias/delete/{materias}',         array( 'as' => 'delete.materias',          'uses' =>'MateriasController@getDelete'));
    Route::controller('materias', 'MateriasController');
    //************ End Materia Prima  ***************************************************	
	
	 //************ Proveedores  ***************************************************
    Route::get('proveedores/',                       array( 'as' => 'see.proveedores',             'uses' =>'ProveedoresController@getIndex'));
    Route::get('proveedores/create',                 array( 'as' => 'create.proveedores',          'uses' =>'ProveedoresController@getCreate'));
    Route::post('proveedores/post/create',           array( 'as' => 'post.create.proveedores',     'uses' =>'ProveedoresController@postCreate'));
    Route::get('proveedores/edit/{proveedores}',     array( 'as' => 'edit.proveedores',            'uses' =>'ProveedoresController@getEdit'));
    Route::post('proveedores/{proveedores}/edit',    array( 'as' => 'post.edit.proveedores',       'uses' =>'ProveedoresController@postEdit'));
    Route::get('proveedores/delete/{id}',            array( 'as' => 'delete.proveedores',          'uses' =>'ProveedoresController@getDelete'));
    Route::get('proveedores/sel',                    array( 'as' => 'sel.proveedores',             'uses' =>'ProveedoresController@getProveedores'));
    Route::controller('Proveedores', 'ProveedoresController');
    //************ End Proveedores  ***************************************************
	
	  //************ Empaques  ***************************************************
    Route::get('empaques/',                          array( 'as' => 'see.empaques',             'uses' =>'EmpaquesController@getIndex'));
    Route::get('empaques/create',                    array( 'as' => 'create.empaques',          'uses' =>'EmpaquesController@getCreate'));
    Route::post('empaques/post/create',              array( 'as' => 'post.create.empaques',     'uses' =>'EmpaquesController@postCreate'));
    Route::post('empaques/add-empaques',             array( 'as' => 'add.empaques',             'uses' =>'EmpaquesController@postNew'));
    Route::get('empaques/edit/{empaques}',           array( 'as' => 'edit.empaques',            'uses' =>'EmpaquesController@getEdit'));
    Route::post('empaques/{empaques}/edit',          array( 'as' => 'post.edit.empaques',       'uses' =>'EmpaquesController@postEdit')); 
    Route::post('empaques/{empaquesmp}/editar',      array( 'as' => 'editar.empaques.emp',      'uses' =>'EmpaquesController@postEditar'));
    Route::get("empaques/unidad",                    array( 'as' => 'empaque.unidad',           'uses' =>'EmpaquesController@getunidad'));
    Route::get('empaques/delete/{empaques}',         array( 'as' => 'delete.empaques',          'uses' =>'EmpaquesController@getDelete'));
    Route::get('empaques/borrar/{empaquesmp}',       array( 'as' => 'borrar.empaques',          'uses' =>'EmpaquesController@getBorrar'));
    Route::controller('Empaques', 'EmpaquesController');
    //************ End Empaques  ***************************************************

  //************ Platillos  ***************************************************
    Route::get('platillos/',                          array( 'as' => 'see.platillos',                  'uses' =>'PlatillosController@getIndex'));
    Route::get('platillos/create',                    array( 'as' => 'create.platillos',               'uses' =>'PlatillosController@getCreate'));
    Route::post('platillos/post/create',              array( 'as' => 'post.create.platillos',          'uses' =>'PlatillosController@postCreate'));
    Route::post('platillos/{platillos}/edit',         array( 'as' => 'post.edit.platillos',            'uses' =>'PlatillosController@postEdit'));  
    Route::post('platillos/{platillosmps}/editar',    array( 'as' => 'editar.platillos',               'uses' =>'PlatillosController@postEditar'));  
    Route::post('platillos/create-platillos',         array( 'as' => 'create.platillos.materias',      'uses' =>'PlatillosController@postNew'));  
    Route::get("platillos/mat",                       array( 'as' => 'mat.platillos',                  'uses' =>'PlatillosController@getMaterias'));
    Route::get("platillos/unid",                      array( 'as' => 'mat.unidades',                   'uses' =>'PlatillosController@getUnidades'));
    Route::controller('Platillos', 'PlatillosController');
    //************ End Platillos  ***************************************************	
	
	 //************ Pedidos  ***************************************************
    Route::get('pedidos/',                          array( 'as' => 'see.pedidos',                   'uses' =>'PedidosController@getIndex'));
    Route::get('pedidos/create',                    array( 'as' => 'create.pedidos',                'uses' =>'PedidosController@getCreate'));
    Route::post('pedidos/post/create',              array( 'as' => 'post.create.pedidos',           'uses' =>'PedidosController@postCreate'));
    Route::post('pedidos/add-platillos',            array( 'as' => 'add.platillos.pedidos',         'uses' =>'PedidosController@postNew'));
    Route::get('pedidos/edit/{pedidos}',            array( 'as' => 'edit.pedidos',                  'uses' =>'PedidosController@getEdit'));
    Route::post('pedidos/{pedidos}/edit',           array( 'as' => 'post.edit.pedidos',             'uses' =>'PedidosController@postEdit'));  
    Route::post('pedidos/{pedidosplat}/editar',     array( 'as' => 'editar.pedidos',                'uses' =>'PedidosController@postEditar'));  
    Route::get('pedidos/plat',                      array( 'as' => 'plat.pedidos',                  'uses' =>'PedidosController@getPlatillos'));
    Route::get('pedidos/delete/{pedidos}',          array( 'as' => 'delete.pedidos',                'uses' =>'PedidosController@getDelete'));
    Route::get('pedidos/borrar/{pedidosplat}',      array( 'as' => 'borrar.pedidos',                'uses' =>'PedidosController@getBorrar'));
    Route::controller('Pedidos', 'PedidosController');
    //************ End Pedidos  ***************************************************
	
	//************ Orden  ***************************************************
    Route::get('orden/',                          array( 'as' => 'see.orden',             'uses' =>'OrdenController@getIndex'));
    Route::post('orden/post/list',                array( 'as' => 'post.list.orden',       'uses' =>'OrdenController@postList'));
    Route::get('orden/create',                    array( 'as' => 'create.orden',          'uses' =>'OrdenController@getCreate'));
    Route::post('orden/add-pedidos',              array( 'as' => 'add.pedidos.orden',     'uses' =>'OrdenController@postNew'));
    Route::post('orden/post/create',              array( 'as' => 'post.create.orden',     'uses' =>'OrdenController@postCreate'));
    Route::get('orden/pedidos',                   array( 'as' => 'pedidos.orden',         'uses' =>'OrdenController@getPedidos'));
    Route::get('orden/edit/{orden}',              array( 'as' => 'edit.orden',            'uses' =>'OrdenController@getEdit'));
    Route::post('orden/{orden}/edit',             array( 'as' => 'post.edit.orden',       'uses' =>'OrdenController@postEdit'));  
    Route::post('orden/{orden}/edit',             array( 'as' => 'post.edit.orden',       'uses' =>'OrdenController@postEdit'));  
    Route::get('orden/show/{orden}/{valor}',      array( 'as' => 'show.orden',            'uses' =>'OrdenController@getShow'));
    Route::get('orden/show/excel/{orden}',        array( 'as' => 'show.excel.orden',      'uses' =>'OrdenController@getShowexcel'));
    Route::get('orden/delete/{orden}',            array( 'as' => 'delete.orden',          'uses' =>'OrdenController@getDelete'));
    Route::get('orden/borrar/{ordenpedido}',      array( 'as' => 'borrar.orden',          'uses' =>'OrdenController@getBorrar'));
    Route::controller('Ordenes', 'OrdenController');
    //************ End Orden  ***************************************************
	
	
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
