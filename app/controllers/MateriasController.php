<?php

class MateriasController extends \BaseController {

	/**
     *  Materias Model
     * @var materias
     */
    protected $materias;
  
	/**
     * Inject the models.
     * @param  materias $materias
     */
    public function __construct(Materias $materias)
    {
       parent::__construct();
       $this->materias = $materias;
    }
	
	/**
	 * Returns all CRequest.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		$materias= Materias::all();
		return View::make('dashboard/materias/index', compact('materias'));
	}
	

	public function getCreate()
	{
		$unidades= Unidades::all();
		return View::make('dashboard/materias/create', compact('unidades'));
	}

	public function postCreate()
	{
	// create the validation rules ------------------------
		if(Input::get('unidad')){		
			$rules = array('nombre' => 'required');
		}else{			
			$rules = array('unidad' => 'required');
		}	
		// do the validation ----------------------------------
		$validator = Validator::make(Input::all(), $rules);

		// check if the validator failed -----------------------
		if ($validator->fails()) {

				return Redirect::back()->withInput()->withErrors($validator);
		} else {		
				
			$materias	= new Materias;		
			$materias->nombre 			= Input::get('nombre');
			$materias->unidad 		 	= Input::get('unidad');
			
			if($materias->save()){
			
			return Redirect::to('dashboard/materias/index/')
						->with('msg', 'Materia Prima Agregada con éxito.')
						->with('class', 'success');
			 
			}else {
					
				return Redirect::back()->withInput()
						->with('msg', '¡Algo salió mal! Los datos no fueron guardados.')
						->with('class', 'error');

			}
		}	
	}

	public function getEdit(Materias $materias)
    {
    	$unidades= Unidades::all();
    	return View::make('dashboard/materias/edit', compact('materias','unidades'));
	}

	public function postEdit(Materias $materias)
	{
		if(Input::get('unidad')){		
			$rules = array('nombre'  => 'required');
		}else{			
			$rules = array('unidad' => 'required');
		}	

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {

				return Redirect::back()->withInput()
						->withErrors($validator);
		} else {		
				
			$oldmaterias= clone $materias;
			$materias->nombre 			= Input::get('nombre');
			$materias->unidad 		 	= Input::get('unidad');
			
			if($materias->update()){
			
			return Redirect::to('dashboard/materias/index/')
						->with('msg', 'Materia Prima Editada con éxito.')
						->with('class', 'success');
			 
			}else {
					
				return Redirect::back()->withInput()
						->with('msg', '¡Algo salió mal! Los datos no fueron editados.')
						->with('class', 'error');

			}
		}
	
	}

	public function getDelete(Materias $materias)
    {
    	$oldmaterias= $materias->id;

       	if($materias->delete(['id'])){

       		$empaques= Empaques::where('materia_prima','=',$oldmaterias)->get();
       		$platillosborrar= PlatillosMp::where('materia_prima','=',$oldmaterias)->get();
       		//haciendo cero la materia prima elimiinada en empaques
       		foreach($empaques as $empaque){
       		
       		$empaque->materia_prima = 0;
       		$empaque->update(['id']);
		    }
			$empaquesborrar= Empaques::where('materia_prima','=',0)->get();

			//eliminado empaques y empaquesmp asociados con materia prima borrada
			foreach($empaquesborrar as $empaqueborrar){
			$empaqueborrarid= $empaqueborrar->id;
			$empaquemp= EmpaquesMp::where('empaques_id','=',$empaqueborrarid)->get();
			
			foreach ($empaquemp as $emp) {
			$emp->delete(['id']);
			}

			$empaqueborrar->delete(['id']);
			}

			foreach ($platillosborrar as $platillos) {
			$platillos->delete(['id']);
			}

			return Redirect::back()
                    ->with('msg', 'Materia Prima eliminada con éxito.')
                    ->with('class', 'success');
		 
		}else {
				
			return Redirect::back()
                    ->with('msg', '¡Algo salió mal! La materia prima no pudo ser eliminada.')
                    ->with('class', 'error');

		}
	}


}
