<?php

class OrdenController extends \BaseController {
	
	protected $orden;
  
    public function __construct(Orden $orden)
    {
        parent::__construct();
        $this->orden = $orden;
    }	
	/**
	 * Returns all CRequest.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		$ordenes = Orden::all();
		return View::make('dashboard/orden/index',compact('ordenes'));
	}

	public function postList()
	{
		$id= Input::get('id');
		$orden= Orden::all();		
		$sucursalesb = Sucursales::all();		
		return View::make('dashboard/orden/list', compact('sucursalesb', 'id', 'orden'));
	}
	
	public function postNew()
	{		
		$orden       	  	   	    = 	new Ordenpedido;		
		$orden ->id_orden	        = 	Input::get('orden');
		$orden ->id_pedido  		= 	Input::get('pedido');
	
		if($orden->save())
		{			
			return Redirect::back()
                    ->with('msg', 'Pedido añadido con éxito.')
                    ->with('class', 'success');		 
		}else 
		{	
			return Redirect::back()
                    ->with('msg', '¡Algo salió mal! El pedido no pudo ser agregado!.')
                    ->with('class', 'error');
		}
	
	}

	public function getCreate()
	{
		$idusuario=Auth::user()->id;
		$usuario=Usuario::where('id','=',$idusuario)->first();
		$sucursal=Sucursales::where('id','=',$usuario->sucursal)->first();
		return View::make('dashboard/orden/create',compact('sucursal'));
	}

	public function getPedidos() 
	{		
		$eleccion= Input::get('eleccion');		
		$pedidos = Pedidos::all();							
		return Response::json($pedidos);		
	}

	public function postCreate()
	{		
		$orden			        = 	new Orden;		
		$orden->responsable     = 	Input::get('responsable');
		$orden->nombre   		= 	Input::get('nombre');
		$exist_sub			    =	Input::get('count_sub');
		
		if($orden->save()){
			
			if($exist_sub == 1 ){
			
				$sub_categorias	    =	Input::get('subcategorias');
				
				foreach ($sub_categorias as $sub_categoria){
				$subcategorias					= 	new Ordenpedido;		
				$subcategorias->id_orden 	    = 	$orden->id;
				$subcategorias->id_pedido    	= 	$sub_categoria;
				$subcategorias->save();
				}

			}
			return Redirect::to('dashboard/orden/')
                    ->with('msg', 'Datos guardados con éxito.')
                    ->with('class', 'success');
		 
		}else {				
			return Redirect::back()->withInput()
                    ->with('msg', '¡Algo salió mal! Los datos no fueron guardados.')
                    ->with('class', 'error');
		}		
	}

	public function getShow(Orden $orden, $valor)
	{
		$valor= $valor;
		$ordenpedido  = Ordenpedido::where('id_orden','=',$orden->id)->get();
		$a=0; $b=0; $c=0; $d=0; $e=0; $f=0;
		
		if(count($ordenpedido)>0){
			foreach($ordenpedido as $ord){
			$orde[$a]=$ord;
				foreach(Pedidos::where('id','=',$ord->id_pedido)->get() as $ped){
				$pedido[$b]=$ped->sucursal;
					foreach(Pedidosplat::where('id_pedido','=',$ped->id)->get() as $pedplat){
					$pedidosplatillos[$c]=$pedplat;
						foreach(Platillos::where('id','=',$pedplat->id_platillo)->get() as $plat){
						$plats[$d]=$plat;
							foreach(PlatillosMp::where('platillos_id','=',$plat->id)->get() as $platmp){
							$platsmp[$e]=$platmp;
								foreach(Materias::where('id','=',$platmp->materia_prima)->get() as $materia){
								$materias[$f]=$materia->id;
								$f++;
								} 
							$e++;
							}
						$d++;
						}
					$c++;
					}	
				$b++;
				}
			$a++;	
			}	
			
			$materiasall= Materias::whereIn('id', $materias)->get();
			$sucursales= Sucursales::whereIn('id', $pedido)->get();
			
			return View::make('dashboard/orden/show',compact('orden','ordenpedido', 'valor', 
													'materiasall','orde','pedido',
													'pedidosplatillos','plats', 'platsmp', 'sucursales'));
		}else{
			return Redirect::back()
						->with('msg', '¡Actualmente la Orden Seleccionada no posee pedidos asociados, vaya a editar y agregue al menos un pedido!')
						->with('class', 'warning');
		}
	}

	//funcion de ver excel con maatwebsite
	public function getShowexcel(Orden $orden)
	{	
	    $data['orden'] = $orden;
		$data['datos']['nombre']= $orden->nombre;
		$data['datos']['responsable']= $orden->Usuario->username;
		$data['datos']['fecha']= $orden->created_at;
		
		$ordenpedido  = Ordenpedido::where('id_orden','=',$orden->id)->get();
		$a=0; $b=0; $c=0; $d=0; $e=0; $f=0;

		foreach($ordenpedido as $ord){
		$orde[$a]=$ord;
			foreach(Pedidos::where('id','=',$ord->id_pedido)->get() as $ped){
			$pedido[$b]=$ped->sucursal;
				foreach(Pedidosplat::where('id_pedido','=',$ped->id)->get() as $pedplat){
				$pedidosplatillos[$c]=$pedplat;
					foreach(Platillos::where('id','=',$pedplat->id_platillo)->get() as $plat){
					$plats[$d]=$plat;
						foreach(PlatillosMp::where('platillos_id','=',$plat->id)->get() as $platmp){
						$platsmp[$e]=$platmp;
							foreach(Materias::where('id','=',$platmp->materia_prima)->get() as $materia){
							$materias[$f]=$materia->id;
							$f++;
							} 
						$e++;
						}
					$d++;
					}
				$c++;
				}	
			$b++;
			}
		$a++;	
		}
				
		$materiasall= Materias::whereIn('id', $materias)->get();
		$sucursales= Sucursales::whereIn('id', $pedido)->get();

																
		$excel = App::make('excel');
			
		Excel::create('orden-'.$orden->id, function($excel) use ($data) {

			$excel->sheet('First sheet', function($sheet) use ($data) {
			
			$sheet->cell('A1', function($cell) {
				$cell->setFontSize(16);
				$cell->setFontWeight('bold');
			});
			
			$sheet->row(1, array('Datos De la Orden de Compra'));
			$sheet->row(2, array('Orden de Compra:', $data['datos']['nombre']));
			$sheet->row(3, array('Responsable:', $data['datos']['responsable']));
			$sheet->row(4, array('Fecha:', $data['datos']['fecha']));
			
				//$sheet->loadView('dashboard.orden.showexcel', ['orden' => $orden,
																//'ordenpedido' => $ordenpedido,
																//'materiasall' => $materiasall,
																//'orde' => $orde,
																//'pedido' => $pedido,
																//'pedidosplatillos' => $pedidosplatillos,
																//'plats' => $plats,
																//'platsmp' => $platsmp,
																//'sucursales' => $sucursales]);		
			});

	   })->download('xls');

	}

	public function getEdit(Orden $orden)
    {
    	$pedidos= Pedidos::all();
    	$ordenpedido= Ordenpedido::where('id_orden','=', $orden->id)->get();
		return View::make('dashboard/orden/edit', compact('orden', 'ordenpedido', 'pedidos'));
	}

	public function postEdit(Orden $orden)
	{		
		$oldorden = clone $orden;
		
		$orden->responsable     = 	Input::get('responsable');
		$orden->nombre   		= 	Input::get('nombre');
		
		if($orden->update(['id'])){
			
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
	
	public function getDelete(Orden $orden)
    {
    	$oldorden= $orden->id;
    	$ordenped= Ordenpedido::where('id_orden','=',$oldorden)->get();

       	if($orden->delete(['id'])){

       	foreach($ordenped as $ordp){
        $ordp->delete(['id']);
       	}
			return Redirect::back()
                    ->with('msg', 'Orden de compra eliminada con éxito.')
                    ->with('class', 'success');		 
		}else {  				
			return Redirect::back()
                    ->with('msg', '¡Algo salió mal! La Orden no pudo ser eliminada.')
                    ->with('class', 'error');
		}
	}

	public function getBorrar(Ordenpedido $ordenpedido)
    {
    	$orden = Ordenpedido::where('id_orden','=',$ordenpedido->id_orden)->get();
    	
		if(count($orden)==1){
    		return Redirect::back()
                    ->with('msg', '¡No se pudo eliminar! La Orden debe contener al menos un pedido.')
                    ->with('class', 'warning');
    	}

    	else{

			if($ordenpedido->delete(['id'])){
				return Redirect::back()
						->with('msg', 'Pedido se ha removido con éxito.')
						->with('class', 'success');			 
			}else {  					
				return Redirect::back()
						->with('msg', '¡Algo salió mal! El Pedido no pudo ser removido.')
						->with('class', 'error');
			}

		}
	}
	
}
