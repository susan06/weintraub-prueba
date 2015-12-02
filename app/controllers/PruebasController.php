<?php

class PruebasController extends BaseController {

    public function __construct()
    {
        parent::__construct();
    }
    

	public function getShowexcelxx(Orden $orden)
	{		
		
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

		$contents = View::make('pruebas.excelprueba')->with('orden', $orden)
															->with('ordenpedido', $ordenpedido)
															->with('materiasall', $materiasall)
															->with('orde', $orde)
															->with('pedido', $pedido)
															->with('pedidosplatillos', $pedidosplatillos)
															->with('plats', $plats)
															->with('platsmp', $platsmp)
															->with('sucursales', $sucursales);		

		$response = Response::make($contents);

		$response->header('Content-Type', 'application/vnd.ms-excel');
		$response->header('Content-Disposition', 'attachment; filename="archivo_prueba.xls"');
		$response->header('Pragma', 'no-cache');
		$response->header('Expires', '0');

		return $response;

	}
	
	public function getShowexcel(Orden $orden)
	{		
		$excel = App::make('excel');
		
		Excel::create('mi_excel_corto', function($excel) use ($orden) {
		
		$orden = $orden;

			$excel->sheet('orden', function($sheet) use ($orden) {

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

				$sheet->loadView('pruebas.excelcorto', ['orden' => $orden,
																'ordenpedido' => $ordenpedido,
																'materiasall' => $materiasall,
																'orde' => $orde,
																'pedido' => $pedido,
																'pedidosplatillos' => $pedidosplatillos,
																'plats' => $plats,
																'platsmp' => $platsmp,
																'sucursales' => $sucursales]);		
			});

	   })->download('xls');

	}
	
	public function xxgetShowexcel(Orden $orden)
	{
	
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
				
	return view::make('pruebas.excelprueba', ['orden' => $orden,
																'ordenpedido' => $ordenpedido,
																'materiasall' => $materiasall,
																'orde' => $orde,
																'pedido' => $pedido,
																'pedidosplatillos' => $pedidosplatillos,
																'plats' => $plats,
																'platsmp' => $platsmp,
																'sucursales' => $sucursales]);	
	}

}
