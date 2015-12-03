<?php

class ProveedoresController extends \BaseController {

	/**
     *  Unidades Model
     * @var empresas
     */
    protected $proveedores;
  
  /**
     * Inject the models.
     * @param  empresas $empresas
     */
    public function __construct(Proveedores $proveedores)
    {
        parent::__construct();
        $this->proveedores = $proveedores;
    }
	
	/**
	 * Returns all CRequest.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		$proveedores= Proveedores::all();
		return View::make('dashboard/proveedores/index', compact('proveedores'));
	}
	

	public function getCreate()
	{
		return View::make('dashboard/proveedores/create');
	}

	public function postCreate()
	{
		$proveedores	  	   	= 	new Proveedores;		
		$proveedores->nombre	    = 	Input::get('nombre');
		$proveedores->empresa	    = 	Input::get('empresa');
		$proveedores->telefono	= 	Input::get('telefono');
		$proveedores->direccion	    = 	Input::get('direccion');
		$proveedores->notas	    = 	Input::get('notas');
	

		if($proveedores->save())
		{
						
			return Redirect::to('dashboard/proveedores/index')
                    ->with('msg', 'Datos guardados con éxito.')
                    ->with('class', 'success');
		 
		}else {
				
			return Redirect::back()->withInput()
                    ->with('msg', '¡Algo salió mal! Los datos no fueron guardados.')
                    ->with('class', 'error');

		}
	}
	

	public function getEdit(Proveedores $proveedores)
    {
		return View::make('dashboard/proveedores/edit',compact('proveedores'));

	}

	public function postEdit(Proveedores $proveedores)
	{

		$proveedores->nombre	    = 	Input::get('nombre');
		$proveedores->empresa	    = 	Input::get('empresa');
		$proveedores->telefono	= 	Input::get('telefono');
		$proveedores->direccion	    = 	Input::get('direccion');
		$proveedores->notas	    = 	Input::get('notas');

		
		if($proveedores->update(['id'])){
			
			return Redirect::to('dashboard/proveedores/index')
                    ->with('msg', 'Proveedor editado con éxito.')
                    ->with('class', 'success');
		 
		}else {
				
			return Redirect::back()
                    ->with('msg', '¡Algo salió mal! Los datos no fueron guardados.')
                    ->with('class', 'error');
		}
	
	
	}

	public function getDelete($id)
    {
       $proveedores = Proveedores::find($id);
       $empaques= EmpaquesMp::where('proveedor','=',$id)->get();

       	if($proveedores->delete(['id']))
       	{
       		foreach ($empaques as $empaque) {
       		$empaque->proveedor = 0;
       		$empaque->update();
       		}

			return Redirect::back()
                ->with('msg', 'Proveedor eliminado con éxito.')
                ->with('class', 'success');
		 
		}else 
		{
				
			return Redirect::back()
                ->with('msg', '¡Algo salió mal! El proveedor no pudo ser eliminado.')
                ->with('class', 'error');
		}

	}

	public function getProveedores() 
 	{
		
		$eleccion= Input::get('eleccion');
			
		$proveedores = Proveedores::all();		

				
		return Response::json($proveedores);		
	}


}
