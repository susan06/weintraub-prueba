<?php

class EmpaquesController extends \BaseController {
	/**
     *  Empresas Model
     * @var empresas
     */
    protected $empaques;
  
  /**
     * Inject the models.
     * @param  empresas $empresas
     */
    public function __construct(Empaques $empaques)
    {
      	parent::__construct();
        $this->empaques = $empaques;
    } 
    
	
	/**
	 * Returns all CRequest.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		$empaques  =  Empaques::where('materia_prima','>',0)->get();
		
		return View::make('dashboard/empaques/index',compact('empaques'));
	}
	

	public function getCreate()
	{
		$empaques  		=  Empaques::where('id','>',0)->lists('materia_prima');
		$materias  		=  Materias::whereNotIn('id',$empaques)->get();


		return View::make('dashboard/empaques/create', compact('empaques','materias'));
	}


	public function postCreate()
	{
		
		$categorias					= 	new Empaques;		
		$categorias->materia_prima	= 	Input::get('nombre');
		$exist_sub					=	Input::get('count_sub');
	if($exist_sub == 1 ){	
		if($categorias->save()){
			
			$sub_categorias	=	Input::get('subcategorias');
			$sub_categorias2	=	Input::get('subcategorias2');
			$sub_categorias3	=	Input::get('subcategorias3');
			$sub_categorias4	=	Input::get('subcategorias4');
			$contador= count($sub_categorias2);

			for($i=0; $i<$contador; $i++){
			$subcategorias					= 	new EmpaquesMp;		
			$subcategorias->nombre			= 	$sub_categorias[$i];
			$subcategorias->cantidad		= 	$sub_categorias2[$i];
			$subcategorias->precio  		= 	$sub_categorias3[$i];
			$subcategorias->proveedor  		= 	$sub_categorias4[$i];
			$subcategorias->empaques_id		= 	$categorias->id;
			$subcategorias->save();
			}
			
			return Redirect::to('dashboard/empaques/index')
                    ->with('msg', 'Datos guardados con éxito.')
                    ->with('class', 'success');
		 
		}else {
				
			return Redirect::back()->withInput()
                    ->with('msg', '¡Algo salió mal! Los datos no fueron guardados.')
                    ->with('class', 'error');

		}

	}else{
    	return Redirect::back()->withInput()
                    ->with('msg', '¡debe agregar al menos un empaque!.')
                    ->with('class', 'warning');


    }

	}

	public function getShow($id)

	{
		$empaques =	Empaques::find($id);
		$empaques_mp  = EmpaquesMp::where('empaques_id','=',$id)->get();
		
		return View::make('dashboard/empaques/show',compact('empaques','empaques_mp'));	
	}

	public function getEdit(Empaques $empaques)
    {
    	
    	$empaquesmp= EmpaquesMp::where('empaques_id','=',$empaques->id)->first();
    	$listaempaquesmp= EmpaquesMp::where('empaques_id','=',$empaques->id)->get();

    	$empaquesa  	=  Empaques::where('id','>',0)->lists('materia_prima');
		$materias  		=  Materias::whereNotIn('id',$empaquesa)->get();

		$proveedores  	= Proveedores::all();

		return View::make('dashboard/empaques/edit', compact('empaques','materias', 'empaquesmp', 'listaempaquesmp', 'proveedores'));
  
	}

	public function getEditar($id)
	{
		
    	  	   	    	
		$empaquesmp  = EmpaquesMp::where('id','=',$id)->first();
		$listaempaquesmp = EmpaquesMp::where('empaques_id','=',$empaquesmp->empaques_id)->get();
		$empaques = Empaques::where('id','=',$empaquesmp->empaques_id)->first();
		$proveedores  	= Proveedores::all();
		return View::make('dashboard/empaques/editar',compact('empaquesmp', 'listaempaquesmp', 'empaques', 'proveedores'));

	}

	public function getUnidad() 
 	{
		
		$eleccion= Input::get('eleccion');
			
		$materias = Materias::where('id','=',$eleccion)->pluck('unidad');
		$unidades = Unidades::where('id','=',$materias)->get();

				
		return Response::json($unidades);	
	}

	public function postNew()
	{
		
		$empaquesmp	  	   	    	= 	new EmpaquesMp;		
		$empaquesmp->empaques_id	= 	Input::get('empaque');
		$empaquesmp->nombre 		= 	Input::get('nombre');
		$empaquesmp->cantidad		= 	Input::get('cantidad');
		$empaquesmp->precio  		= 	Input::get('precio');
		$empaquesmp->proveedor  	= 	Input::get('proveedor');
		

		if($empaquesmp->save())
		{
			
			return Redirect::back()
                    ->with('msg', 'Empaque añadido con éxito.')
                    ->with('class', 'success');
		 
		}else 
		{	
			return Redirect::back()
                    ->with('msg', '¡Algo salió mal! El platillo no pudo ser eliminada.')
                    ->with('class', 'error');
		}
	
	}


	public function postEdit(Empaques $empaques)
	{
		$oldempaques = clone $empaques;

		$empaques->materia_prima  = 	Input::get('materia');

		if($empaques->update(['id']))
		{
			return Redirect::back()->withInput()
                    ->with('msg', 'Datos del empaque editados con éxito.')
                    ->with('class', 'success');
		 
		}else {
				
			return Redirect::back()->withInput()
                    ->with('msg', '¡Algo salió mal! Los datos no fueron editados.')
                    ->with('class', 'error');

		}
    }

    public function postEditar(EmpaquesMp $empaquesmp)
	{
		
		$oldempaquesmp = clone $empaquesmp;

		$empaquesmp->nombre    		= 	Input::get('nombre');
		$empaquesmp->cantidad    	= 	Input::get('cantidad');
		$empaquesmp->precio     	= 	Input::get('precio');
		$empaquesmp->proveedor     	= 	Input::get('proveedor');
	    
		if($empaquesmp->update(['id'])){
			
		return Redirect::back()
                    ->with('msg', 'Empaque editado con éxito.')
                    ->with('class', 'success');
		 
		}else 
		{	
			return Redirect::back()
                    ->with('msg', '¡Algo salió mal! el empaque no pudo ser editado.')
                    ->with('class', 'warning');
		}
	}

    public function getDelete(Empaques $empaques)
    {
       
       $empaquesmp= EmpaquesMp::where('empaques_id','=',$empaques->id)->get();

       	if($empaques->delete(['id'])){
       	//elimino los subempaques 
       	foreach($empaquesmp as $emp){
       	$emp->delete(['id']);
       	}

		return Redirect::back()
                    ->with('msg', 'Empaque eliminado con éxito.')
                    ->with('class', 'success');
		 
		}else {
				
			return Redirect::back()
                    ->with('msg', '¡Algo salió mal! El Empaque no pudo ser eliminado.')
                    ->with('class', 'error');

		}
	

 	}

 	public function getBorrar(EmpaquesMp $empaquesmp)
    {
    	$oldempaquesmp= $empaquesmp->id;
    	$idempaque= EmpaquesMp::where('id','=',$oldempaquesmp)->pluck('empaques_id');
    	$totalempaques= EmpaquesMp::where('empaques_id','=',$idempaque)->get();

    if(count($totalempaques)==1){

    		return Redirect::back()
                    ->with('msg', '¡No se pudo eliminar! debe existir al menos un empaque para la materia.')
                    ->with('class', 'warning');
    	}

    else{

	    if($empaquesmp->delete(['id'])){

				return Redirect::back()
	                    ->with('msg', 'El empaque se ha removido con éxito.')
	                    ->with('class', 'success');
			 
			}else {  
					
				return Redirect::back()
	                    ->with('msg', '¡Algo salió mal! El Empaque no pudo ser removido.')
	                    ->with('class', 'error');

			}
		}

	}

}
