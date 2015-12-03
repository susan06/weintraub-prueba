<?php

class UnidadesController extends \BaseController {

/**
     *  Unidades Model
     * @var empresas
     */
    protected $unidades;
  
  /**
     * Inject the models.
     * @param  empresas $empresas
     */
    public function __construct(Unidades $unidades)
    {
        parent::__construct();
        $this->unidades = $unidades;
    }
	
	/**
	 * Returns all CRequest.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		$unidades= Unidades::all();
		return View::make('dashboard/unidades/index', compact('unidades'));
	}
	

	public function getCreate()
	{
		return View::make('dashboard/unidades/create');
	}

	public function postCreate()
	{

	// create the validation rules ------------------------
		if(Input::get('unidad')){		
			$rules = array('abreviatura'        => 'required');
		}else{			
			$rules = array('unidad' => 'required');
		}	

		// do the validation ----------------------------------
		$validator = Validator::make(Input::all(), $rules);

	// check if the validator failed -----------------------
	if ($validator->fails()) {

			return Redirect::back()->withInput()
					->withErrors($validator);
    } else {		
			
		$Unidades	= new Unidades;		
		$Unidades->nombre 			= Input::get('unidad');
		$Unidades->abreviatura 		= Input::get('abreviatura');
		
		if($Unidades->save()){

		
		return Redirect::to('dashboard/unidades/index/')
                    ->with('msg', 'Unidad creada con éxito.')
                    ->with('class', 'success');
		 
		}else {
				
			return Redirect::back()->withInput()
                    ->with('msg', '¡Algo salió mal! Los datos no fueron guardados.')
                    ->with('class', 'error');

		}
	}
	
	}
	
	
	public function getEdit( Unidades $unidades)
    {    
		return View::make('dashboard/unidades/edit',compact('unidades'));
	}

	public function postEdit( Unidades $unidades)
	{
	// create the validation rules ------------------------
		if(Input::get('unidad')){		
			$rules = array('abreviatura' => 'required');
		}else{			
			$rules = array('unidad' => 'required');
		}	

		// do the validation ----------------------------------
		$validator = Validator::make(Input::all(), $rules);

	// check if the validator failed -----------------------
	if ($validator->fails()) {

			return Redirect::back()->withInput()
					->withErrors($validator);
    } else {		
			
		$oldunidades= clone $unidades;	
		$unidades->nombre 			= Input::get('unidad');
		$unidades->abreviatura 		= Input::get('abreviatura');
		
		if($unidades->update()){

		
		return Redirect::to('dashboard/unidades/index/')
                    ->with('msg', 'Unidad Editada con éxito.')
                    ->with('class', 'success');
		 
		}else {
				
			return Redirect::back()->withInput()
                    ->with('msg', '¡Algo salió mal! Los datos no fueron editados.')
                    ->with('class', 'error');

		}
	}
	
	}

	public function getDelete(Unidades $unidades)
    {
    	$oldunidades= $unidades->id;

       	if($unidades->delete(['id'])){

       		$materias= Materias::where('unidad','=',$oldunidades)->get();

       		foreach($materias as $materia){

       			$materia->unidad = 0;
       			$materia->update();
       		}
			return Redirect::back()
                    ->with('msg', 'Unidad eliminada con éxito.')
                    ->with('class', 'success');
		 
		}else {
				
			return Redirect::back()
                    ->with('msg', '¡Algo salió mal! La unidad no pudo ser eliminada.')
                    ->with('class', 'error');

		}
	}

}
