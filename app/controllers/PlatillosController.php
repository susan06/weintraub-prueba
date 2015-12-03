<?php

class PlatillosController extends \BaseController {
	/**
     *  Platillos Model
     * @var platillos
     */
    protected $platillos; 
	/**
     * Inject the models.
     * @param  platillos $platillos
     */
    public function __construct(Platillos $platillos)
    {
        parent::__construct();
        $this->platillos = $platillos;
    }	
	/**
	 * Returns all CRequest.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		$platillos = Platillos::all(); 		
		return View::make('dashboard/platillos/index',compact('platillos'));
	}
	

	public function getCreate()
	{
		$materias = Materias::all(); 		
		return View::make('dashboard/platillos/create',compact('materias'));	
	}
	
	public function postCreate()
	{
		$categorias			= 	new Platillos;		
		$categorias->nombre	= 	Input::get('nombre');
		$exist_sub			=	Input::get('count_sub');
		
		if($exist_sub == 1 ){		
			if($categorias->save()){
				
				if($exist_sub == 1 ){
				
					$sub_categorias	=	Input::get('subcategorias');
					$sub_categorias2	=	Input::get('subcategorias2');
					$contador= count($sub_categorias2);

					for($i=0; $i<$contador; $i++){
					$subcategorias					= 	new PlatillosMp;		
					$subcategorias->materia_prima	= 	$sub_categorias[$i];
					$subcategorias->cantidad_mp		= 	$sub_categorias2[$i];
					$subcategorias->platillos_id	= 	$categorias->id;
					$subcategorias->save();
					}

				}
				return Redirect::to('dashboard/platillos/index')
						->with('msg', 'Datos guardados con éxito.')
						->with('class', 'success');
			 
			}else {
					
				return Redirect::back()->withInput()
						->with('msg', '¡Algo salió mal! Los datos no fueron guardados.')
						->with('class', 'error');

			}
		}else{
			return Redirect::back()->withInput()
						->with('msg', '¡debe agregar al menos una materia!.')
						->with('class', 'warning');
		}	
	}

	public function getShow($id)
	{		
		$platillos =	Platillos::find($id);
		$platillosmp  = PlatillosMp::where('platillos_id','=',$id)->get();		
		return View::make('dashboard/platillos/show',compact('platillos','platillosmp'));		
	}

	public function getEdit($id)
    {
    	$materias = Materias::all(); 
    	$platillos = Platillos::find($id);
    	$platillosmp  = PlatillosMp::where('platillos_id','=',$id)->get();		
		return View::make('dashboard/platillos/edit',compact('platillos','platillosmp','materias')); 
	}

	public function postEdit(Platillos $platillos)
	{
		$platillos->nombre     	= 	Input::get('platillo');
		if($platillos->update(['id'])){
			
		return Redirect::back()
                    ->with('msg', 'Datos editados con éxito.')
                    ->with('class', 'success');
		 
		}else 
		{	
			return Redirect::back()
                    ->with('msg', '¡Algo salió mal! La materia prima no pudo ser modificada.')
                    ->with('class', 'error');
		}

	}

	public function getEditar($id)
	{		
    	$platillosmps  = PlatillosMp::find($id);
    	$materias = Materias::all();    		
		return View::make('dashboard/platillos/editar',compact('platillosmps','materias'));
	}
	
	public function postEditar($id)
	{		
		$platillosmp = PlatillosMp::find($id);
		$platillosmp->materia_prima    	= 	Input::get('materia');
	    $platillosmp->cantidad_mp  	= 	Input::get('cantidadm');

		if($platillosmp->update(['id'])){
			
		return Redirect::back()
                    ->with('msg', 'Platillo editado con éxito.')
                    ->with('class', 'success');	 
		}else 
		{	
			return Redirect::back()
                    ->with('msg', '¡Algo salió mal! el platillo no pudo ser editado.')
                    ->with('class', 'warning');
		}
	}
	
	public function postNew()
	{		
		$platillosmp	  	   	    = 	new PlatillosMp;		
		$platillosmp->materia_prima	    = 	Input::get('materia');
		$platillosmp->cantidad_mp	= 	Input::get('cantidadm');
		$platillosmp->platillos_id	= 	Input::get('platillos_id');
		
		if($platillosmp->save())
		{			
			return Redirect::back()
                    ->with('msg', 'Materia prima añadida con éxito.')
                    ->with('class', 'success');		 
		}
		else 
		{	
			return Redirect::back()
                    ->with('msg', '¡Algo salió mal! La materia prima no pudo ser eliminada.')
                    ->with('class', 'error');
		}
	
	}
 
	public function getDelete($id)
    {
       $platillos = Platillos::find($id);
       $platillosmps = PlatillosMp::find($id);
       $pedidosplat = Pedidosplat::where('id_platillo','=',$id)->get();

       	if($platillos->delete())
       	{
       		PlatillosMp::where('platillos_id', '=', $id)->delete();
       		Pedidosplat::where('id_platillo','=',$id)->delete();

			return Redirect::back()
                    ->with('msg', 'Platillo eliminado con éxito.')
                    ->with('class', 'success');
		 
		}else 
		{	
			return Redirect::back()
                    ->with('msg', '¡Algo salió mal! el platillo no pudo ser eliminado.')
                    ->with('class', 'error');
		}
 	}

 	public function getDestroy($id)
    {
       
       $platillosmps = PlatillosMp::find($id);
       
       $idplatillo= PlatillosMp::where('id','=',$id)->pluck('platillos_id');
       $totalplatillos= PlatillosMp::where('platillos_id','=',$idplatillo)->get();

       if(count($totalplatillos)==1){

    		return Redirect::back()
                    ->with('msg', '¡No se pudo eliminar! debe existir al menos una materia.')
                    ->with('class', 'warning');
    	}
	   else
		{
			if($platillosmps->delete())
			{
				return Redirect::back()
						->with('msg', 'Materia prima eliminada con éxito.')
						->with('class', 'success');
			 
			}else 
			{	
				return Redirect::back()
						->with('msg', '¡Algo salió mal! La materia prima no pudo ser eliminada.')
						->with('class', 'error');
			}
		}
 	}
 	
 	public function loadSub() 
 	{
 		$id = Input::get("id");
	 	$sub = SubCategorias::where("categorias_id","=",$id)->get();
	 	return Response::json(array(
 			"sub" => $sub
 		));
 	}

 	public function getMaterias() 
 	{		
		$eleccion= Input::get('eleccion');			
		$materias = Materias::all();	
		$unidades= Unidades::all();						
		return Response::json($materias);		
	}

	public function getUnidades() 
 	{	
		$eleccion= Input::get('eleccion');			
		$materias = Materias::where('id','=',$eleccion)->first();	
		$unidades= Unidades::where('id','=',$materias->unidad)->get();			
		return Response::json($unidades);		
	}


}
