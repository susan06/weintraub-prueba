<?php

class SucursalesController extends \BaseController {
	 	
	public function index()
	{
		return View::make('dashboard/sucursales/index', compact('sucursales'));
	}
	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return View::make('dashboard/sucursales/create');
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$sucursales	= new Sucursales;		
		$sucursales->sucursal 	= Input::get('sucursal');
		
		
		if($sucursales->save()){

		
		return Redirect::to('dashboard/sucursales/')
                    ->with('msg', 'Sucursal agregada con éxito.')
                    ->with('class', 'success');
		 
		}else {
				
			return Redirect::back()->withInput()
                    ->with('msg', '¡Algo salió mal! Los datos no fueron guardados.')
                    ->with('class', 'error');

		}
	}
	/**
	 * Display the specified resource.
	 */
	public function show($id)
	{
		//
	}
	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Sucursales $sucursales)
	{
		return View::make('dashboard/sucursales/edit',compact('sucursales'));
	}
	/**
	 * Update the specified resource in storage.
	 */
	public function update(Sucursales $sucursales)
	{
		$oldsucursales 			= clone $sucursales;	
		$sucursales->sucursal 	= Input::get('sucursal');
				
		if($sucursales->update()){
		
			return Redirect::to('dashboard/sucursales/')
                    ->with('msg', 'Sucursal Editada con éxito.')
                    ->with('class', 'success');
		 
		}else {
				
			return Redirect::back()->withInput()
                    ->with('msg', '¡Algo salió mal! Los datos no fueron editados.')
                    ->with('class', 'error');

		}
	}
	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Sucursales $sucursales)
	{
		 if($sucursales->delete(['id'])){
      		
			return Redirect::back()
                    ->with('msg', 'Sucursal eliminada con éxito.')
                    ->with('class', 'success');
		 
		}else {
				
			return Redirect::back()
                    ->with('msg', '¡Algo salió mal! La sucursal no pudo ser eliminada.')
                    ->with('class', 'error');

		}
	}

}
