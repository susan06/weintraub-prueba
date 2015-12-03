<?php

class PedidosController extends \BaseController {
	/**
     *  Empresas Model
     * @var empresas
     */
    protected $pedidos;  
	/**
     * Inject the models.
     * @param  empresas $empresas
     */
    public function __construct(Pedidos $pedidos)
    {
        parent::__construct();
        $this->pedidos = $pedidos;
    }
	
	/**
	 * Returns all CRequest.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		$pedidos= Pedidos::all();
		return View::make('dashboard/pedidos/index', compact('pedidos'));
	}	

	public function getCreate()
	{
		$sucursales= Sucursales::all();
		return View::make('dashboard/pedidos/create', compact('sucursales'));
	}

	public function postCreate()
	{
		$fecha      			= 	Input::get('fecha'); 
		$fecha_entrega 			= 	strftime("%Y-%m-%d",strtotime($fecha));
		$pedidos			    = 	new Pedidos;		
		$pedidos->responsable   = 	Input::get('responsable');
		$pedidos->sucursal      = 	Input::get('sucursal');
		$pedidos->fecha_entrega = 	$fecha_entrega;
		$pedidos->nombre   		= 	Input::get('nombre');
		$exist_sub			    =	Input::get('count_sub');
		
		if($exist_sub == 1 ){	
		
			if($pedidos->save()){

			  if($exist_sub == 1 ){
				
				$sub_categorias	    =	Input::get('subcategorias');
				$sub_categorias2	=	Input::get('subcategorias2');
				$contador= count($sub_categorias2);

					for($i=0; $i<$contador; $i++){
					$subcategorias					= 	new Pedidosplat;		
					$subcategorias->id_platillo 	= 	$sub_categorias[$i];
					$subcategorias->cantidad		= 	$sub_categorias2[$i];
					$subcategorias->id_pedido    	= 	$pedidos->id;
					$subcategorias->save();
					}
				}
				return Redirect::to('dashboard/pedidos')
						->with('msg', 'Datos guardados con éxito.')
						->with('class', 'success');
			  
			}else {
					
				return Redirect::back()->withInput()
						->with('msg', '¡Algo salió mal! Los datos no fueron guardados.')
						->with('class', 'error');

			}
		}else{
			return Redirect::back()->withInput()
						->with('msg', '¡debe agregar al menos un platillo!.')
						->with('class', 'warning');
		}
		
	}
	
	public function getEdit(Pedidos $pedidos)
    {
    	$platillos = Platillos::all(); 
    	$listaplatillos= Pedidosplat::where('id_pedido','=',$pedidos->id)->get();
    	$sucursales= Sucursales::all();
		return View::make('dashboard/pedidos/edit', compact('pedidos', 'platillos', 'listaplatillos', 'sucursales'));
  
	}

	public function getEditar($id)
	{
		
    	$pedidosplat  = Pedidosplat::find($id);
    	$idpedidos    = Pedidosplat::where('id','=',$id)->pluck('id_pedido');
    	$listaplatillos= Pedidosplat::where('id_pedido','=',$idpedidos)->get();

    	$platillos= Platillos::all();
    	   	    	
		
		return View::make('dashboard/pedidos/editar',compact('pedidosplat', 'platillos','listaplatillos'));

	}

	public function postEdit(Pedidos $pedidos)
	{
		
		$oldpedidos = clone $pedidos;
		
		$fecha      			= 	Input::get('fecha'); 
		$fecha_entrega 			= 	strftime("%Y-%m-%d",strtotime($fecha));
		$pedidos->responsable   = 	Input::get('responsable');
		$pedidos->sucursal      = 	Input::get('sucursal');
		$pedidos->fecha_entrega = 	$fecha_entrega;
		$pedidos->nombre   		= 	Input::get('nombre');
		
		if($pedidos->update(['id'])){
			
		return Redirect::back()
                    ->with('msg', 'Datos editados con éxito.')
                    ->with('class', 'success');
		 
		}else 
		{	
			return Redirect::back()
                    ->with('msg', '¡Algo salió mal! los datos no pudieron ser modificados.')
                    ->with('class', 'error');
		}

	}


    public function postEditar(Pedidosplat $pedidosplat)
	{
		
		$oldpedidosplat = clone $pedidosplat;

		$pedidosplat->id_platillo    	= 	Input::get('id_platillo');
	    $pedidosplat->id_pedido	    	= 	Input::get('id_pedido');
	    $pedidosplat->cantidad	    	= 	Input::get('cantidad');

		if($pedidosplat->update(['id'])){
			
		return Redirect::back()
                    ->with('msg', 'Platillo editado con éxito.')
                    ->with('class', 'success');
		 
		}else 
		{	
			return Redirect::back()
                    ->with('msg', '¡Algo salió mal! el Platillo no pudo ser editado.')
                    ->with('class', 'warning');
		}
	}

    public function getPlatillos () {
		
	$eleccion= Input::get('eleccion');
		
	$platillos = Platillos::all();				
			
	return Response::json($platillos);		

	}

	public function getShow($id)

	{
		
		$pedidos =	Pedidos::find($id);
		$pedidosplat  = Pedidosplat::where('id_pedido','=',$id)->get();
		
		return View::make('dashboard/pedidos/show',compact('pedidos','pedidosplat'));
		
	}

	public function postNew()
	{		
		$pedidosplat	  	   	    = 	new Pedidosplat;		
		$pedidosplat->id_platillo	= 	Input::get('platillo');
		$pedidosplat->id_pedido		= 	Input::get('pedido');
		$pedidosplat->cantidad		= 	Input::get('cantidad');
		
		if($pedidosplat->save())
		{		
			return Redirect::back()
                    ->with('msg', 'Platillo añadido con éxito.')
                    ->with('class', 'success');		 
		}else 
		{	
			return Redirect::back()
                    ->with('msg', '¡Algo salió mal! El platillo no pudo ser eliminada.')
                    ->with('class', 'error');
		}
	
	}

	public function getDelete(Pedidos $pedidos)
    {
    	$oldpedidos= $pedidos->id;

       	if($pedidos->delete(['id'])){
       		Pedidosplat::where('id_pedido','=',$oldpedidos)->delete();
       		Ordenpedido::where('id_pedido','=',$oldpedidos)->delete();

			return Redirect::back()
                    ->with('msg', 'Pedido eliminado con éxito.')
                    ->with('class', 'success');
		 
		}else {  
				
			return Redirect::back()
                    ->with('msg', '¡Algo salió mal! El pedido no pudo ser eliminada.')
                    ->with('class', 'error');

		}
	}

	public function getBorrar(Pedidosplat $pedidosplat)
    {
    	$oldpedidosplat= $pedidosplat->id;
    	$idpedpalt= Pedidosplat::where('id','=',$oldpedidosplat)->pluck('id_pedido');
    	$totalpedidosplat=Pedidosplat::where('id_pedido','=',$idpedpalt)->get();

    	if(count($totalpedidosplat)==1){

    		return Redirect::back()
                    ->with('msg', '¡No se pudo eliminar! el pedido debe contener al menos un platillo.')
                    ->with('class', 'warning');

    	}else{

			if($pedidosplat->delete(['id'])){

				return Redirect::back()
						->with('msg', 'Platillo se ha removido con éxito.')
						->with('class', 'success');
			 
			}else {  
					
				return Redirect::back()
						->with('msg', '¡Algo salió mal! El Platillo no pudo ser removido.')
						->with('class', 'error');

			}

		}
	}
}
