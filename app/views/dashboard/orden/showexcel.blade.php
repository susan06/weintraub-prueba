<?php
header("Content-type: text/csv"); 
header("Content-Disposition: attachment; filename=file.csv");
header("Pragma: no-cache"); 
header("Expires: 0");
?>

<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table>
 <tbody>
 
   <tr>
   <td>Datos De la Orden de Compra:</td>
   <td><b>{{$orden->nombre}}</b></td>
   </tr>
   
   <tr>
   <td>Responsable:</td>
   <td><b>{{$orden->Usuario->username}}</b></td>
   </tr>
   
   <tr>
   <td>Fecha:</td>
   <td><b>{{$orden->created_at}}</b></td>
  </tr>
  
   <tr>
   <td></td>
  </tr>
  
  <tr>
   <td><h3>Materia prima necesaria por platillo</h3></td>
  </tr>
  
  <tr>
   <td></td>
  </tr>
  
  <tr>
   <td><b>Pedido</b></td>
   <td><b>Sucursal</b></td>
   <td><b>Platillo</b></td>
   <td><b>Unidades</b></td>
   <td><b>Materia Prima</b></td>
   <td><b>Cantidad (por platillo)</b></td>
  </tr>

     @foreach($ordenpedido as $ord)
    @foreach(Pedidos::where('id','=',$ord->id_pedido)->get() as $ped)
    @foreach(Pedidosplat::where('id_pedido','=',$ped->id)->get() as $pedplat)
      @foreach(Platillos::where('id','=',$pedplat->id_platillo)->get() as $plat)
      @foreach(PlatillosMp::where('platillos_id','=',$plat->id)->get() as $platmp)
        @foreach(Materias::where('id','=',$platmp->materia_prima)->get() as $materia)
        <tr>
          <td>{{$ped->nombre}}</td>
          <td>{{$ped->Sucursales->sucursal}}</td>
          <td>{{$plat->nombre}}</td>
          <td>{{$pedplat->cantidad}}</td>
          <td>{{$materia->nombre}}</td>
          <td>{{$platmp->cantidad_mp}} {{$materia->Unidades->nombre}}</td>
        </tr> 
        @endforeach
      @endforeach
      @endforeach
     @endforeach
    @endforeach
    @endforeach   

   <tr>
   <td></td>
  </tr>
  
  <tr>
   <td><h3>Orden de Compra General</h3></td>
  </tr>
  
  <tr>
   <td></td>
  </tr>
  
    <tr>
   <td><b>Materia Prima</b></td>
   <td><b>Cantidad Necesaria</b></td>
   <td><b>Empaque</b></td>
   <td><b>Cantidad</b></td>
   <td><b>Costo</b></td>
   <td><b>Costo total</b></td>
   <td><b>Sobrante</b></td>
  </tr>
  {{'';$preciototal =0;}}
    @foreach($materiasall as $mat)                 
                        <tr>                       
                        <td>{{$mat->nombre}}</td>
                        
            <td>
                        {{ ''; $total =0; $cant =0;$sobrante=0;}}
                        @foreach($ordenpedido as $ord)
                          @foreach(Pedidos::where('id','=',$ord->id_pedido)->get() as $ped)
                            @foreach(Pedidosplat::where('id_pedido','=',$ped->id)->get() as $pedplat)
                              @foreach(Platillos::where('id','=',$pedplat->id_platillo)->get() as $plat)
                                @foreach(PlatillosMp::where('platillos_id','=',$plat->id)->get() as $platmp)

                                  @if($mat->id==$platmp->materia_prima)
                                  {{ ''; $total=$total+($platmp->cantidad_mp*$pedplat->cantidad)}} 
                                  @endif

                                @endforeach
                              @endforeach
                           @endforeach
                          @endforeach
                        @endforeach 
                        {{$total}} {{$mat->Unidades->nombre}}
                        </td>

                        {{ ''; $total =0; $cant =0;$sobrante=0;}}
                        @foreach($ordenpedido as $ord)
                          @foreach(Pedidos::where('id','=',$ord->id_pedido)->get() as $ped)
                            @foreach(Pedidosplat::where('id_pedido','=',$ped->id)->get() as $pedplat)
                              @foreach(Platillos::where('id','=',$pedplat->id_platillo)->get() as $plat)
                                @foreach(PlatillosMp::where('platillos_id','=',$plat->id)->get() as $platmp)

                                  @if($mat->id==$platmp->materia_prima)
                                  {{ ''; $total=$total+($platmp->cantidad_mp*$pedplat->cantidad)}} 
                                  @endif

                                @endforeach
                              @endforeach
                           @endforeach
                          @endforeach
                        @endforeach 

                          <td>
                        <!---muestro los empaques -->
                        {{ ''; $i=0; }}
                        @foreach(Empaques::where('materia_prima','=',$mat->id)->get() as $emp) 
                            <!---muestro los empaques que incluyan las materias primas del pedido -->
                              @foreach(EmpaquesMp::where('empaques_id','=',$emp->id)->orderBy('cantidad', 'desc')->get() as $empmp)
                                    {{ ''; $cant=($total - ($total%$empmp->cantidad)) / $empmp->cantidad;}}
                                    @if($total>0) 
                                    @if($cant>0)

                                    {{''; $vcantidad[$i]=$empmp->cantidad; $vprecio[$i]=$empmp->precio; $vcant[$i]=$cant;$vid[$i]=$empmp->id; $i++;}}
                                                            
                                    @endif
                                    @endif
                                    {{ ''; $total=$total%$empmp->cantidad; }}
                              @endforeach 
                        @endforeach
                        <?php for($j=0; $j<$i; $j++){ ?>
                        
                        @if($vid[$j]==$empmp->id)
                        @if($total>0)
                        {{$vcantidad[$j]}} {{$mat->Unidades->nombre}}<br>
                        @else
                        {{$vcantidad[$j]}} {{$mat->Unidades->nombre}}<br>
                        @endif
                        @else
                        {{$vcantidad[$j]}} {{$mat->Unidades->nombre}}<br>
                        @endif
                      
                        <?php  }  ?>

                        @if($total>0) {{'';$sobrante=$empmp->cantidad-$total}} @if($cant<=0){{$empmp->cantidad}} {{$mat->Unidades->nombre}}@endif @endif                      

                        </td>

                        <td align="center">
                          <?php for($j=0; $j<$i; $j++){ ?>
                        
                        @if($vid[$j]==$empmp->id)
                        @if($total>0)
                        {{$vcant[$j]+1}}<br>
                        @else
                        {{$vcant[$j]}}<br>
                        @endif
                        @else
                        {{$vcant[$j]}}<br>
                        @endif
                      
                        <?php  }  ?>

                        @if($total>0) @if($cant<=0) 1 @endif @endif
                          </td>
                          <td>
                            <?php for($j=0; $j<$i; $j++){ ?>
                        
                        @if($vid[$j]==$empmp->id)
                        @if($total>0)
                        ${{($vcant[$j]+1)*$vprecio[$j]}}<br>
                        @else
                        ${{$vcant[$j]*$vprecio[$j]}}<br>
                        @endif
                        @else
                        ${{$vcant[$j]*$vprecio[$j]}}<br>
                        @endif
                      
                        <?php  }  ?>

                        @if($total>0) @if($cant<=0)${{$empmp->precio}}@endif @endif
                          </td>

                         {{ ''; $total =0; $cant =0; $precio =0;}}
                        @foreach($ordenpedido as $ord)
                          @foreach(Pedidos::where('id','=',$ord->id_pedido)->get() as $ped)
                            @foreach(Pedidosplat::where('id_pedido','=',$ped->id)->get() as $pedplat)
                              @foreach(Platillos::where('id','=',$pedplat->id_platillo)->get() as $plat)
                                @foreach(PlatillosMp::where('platillos_id','=',$plat->id)->get() as $platmp)

                                  @if($mat->id==$platmp->materia_prima)
                                  {{ ''; $total=$total+($platmp->cantidad_mp*$pedplat->cantidad)}} 
                                  @endif

                                @endforeach
                              @endforeach
                           @endforeach
                          @endforeach
                        @endforeach 

                        <td >
                   <!---muestro los empaques -->

            @foreach(Empaques::where('materia_prima','=',$mat->id)->get() as $emp) 
                <!---muestro los empaques que incluyan las materias primas del pedido -->
                   @foreach(EmpaquesMp::where('empaques_id','=',$emp->id)->orderBy('cantidad', 'desc')->get() as $empmp)
                        {{ ''; $cant=($total - ($total%$empmp->cantidad)) / $empmp->cantidad;}}
                        @if($total>0) 
                        @if($cant>0)
                        {{'';$precio=$precio+$cant*$empmp->precio}}
                        @endif
                        @endif
                        {{ ''; $total=$total%$empmp->cantidad; }}
                      @endforeach 
                      @if($precio>0)
                      {{'';$preciototal=$preciototal+$precio}}
                      @endif
                    @endforeach

                        @if($total>0) {{'';$precio=$precio+$empmp->precio;$preciototal=$preciototal+$empmp->precio}} @endif
                        
                        ${{$precio}} 

                        </td>

                        <td>
                        @if($sobrante ==0)
                        -
                        @else
                        {{$sobrante}} {{$mat->Unidades->nombre}}
                        @endif
                        </td>
                        
                       </tr>                   
        @endforeach 

  <tr>
   <td></td>
  </tr>
  
  <tr>
   <td><h3>Compra Detallada</h3></td>
  </tr>
  
   <tr>
   <td></td>
  </tr>
  
    @foreach($sucursales as $suc)
  
        {{'';$preciototal =0;}}
            <tr><td>Sucursal:</td><td><h4>{{$suc->sucursal}}</h4></td></tr>
    
            <tr>
               <td><b>Materia Prima</b></td>
               <td><b>Cantidad Necesaria</b></td>
               <td><b>Empaque</b></td>
               <td><b>Cantidad</b></td>
               <td><b>Costo</b></td>
               <td><b>Costo total</b></td>
               <td><b>Sobrante</b></td>                
            </tr>
      
          @foreach($materiasall as $mat) 
      
           {{ ''; $total =0; $cant=0;}}
          @foreach($ordenpedido as $ord)
            @foreach(Pedidos::where('id','=',$ord->id_pedido)->where('sucursal','=',$suc->id)->get() as $ped)
            @foreach(Pedidosplat::where('id_pedido','=',$ped->id)->get() as $pedplat)
              @foreach(Platillos::where('id','=',$pedplat->id_platillo)->get() as $plat)
              @foreach(PlatillosMp::where('platillos_id','=',$plat->id)->get() as $platmp)

                @if($mat->id==$platmp->materia_prima)
                {{ ''; $total=$total+($platmp->cantidad_mp*$pedplat->cantidad)}} 
                @endif

              @endforeach
              @endforeach
             @endforeach
            @endforeach
          @endforeach 
      
            @if($total>0)
                      
                       <tr>                     
                        <td>{{$mat->nombre}}</td>    
                        <td>
              {{ ''; $total =0; $cant=0;$sobrante=0;}}
              @foreach($ordenpedido as $ord)
                @foreach(Pedidos::where('id','=',$ord->id_pedido)->where('sucursal','=',$suc->id)->get() as $ped)
                @foreach(Pedidosplat::where('id_pedido','=',$ped->id)->get() as $pedplat)
                  @foreach(Platillos::where('id','=',$pedplat->id_platillo)->get() as $plat)
                  @foreach(PlatillosMp::where('platillos_id','=',$plat->id)->get() as $platmp)

                    @if($mat->id==$platmp->materia_prima)
                    {{ ''; $total=$total+($platmp->cantidad_mp*$pedplat->cantidad)}} 
                    @endif

                  @endforeach
                  @endforeach
                 @endforeach
                @endforeach
              @endforeach 
              {{$total}} {{$mat->Unidades->nombre}}
                          </td>
              
                            {{ ''; $total =0; $cant=0;$sobrante=0;}}
                            @foreach($ordenpedido as $ord)
                              @foreach(Pedidos::where('id','=',$ord->id_pedido)->where('sucursal','=',$suc->id)->get() as $ped)
                                @foreach(Pedidosplat::where('id_pedido','=',$ped->id)->get() as $pedplat)
                                  @foreach(Platillos::where('id','=',$pedplat->id_platillo)->get() as $plat)
                                    @foreach(PlatillosMp::where('platillos_id','=',$plat->id)->get() as $platmp)

                                      @if($mat->id==$platmp->materia_prima)
                                      {{ ''; $total=$total+($platmp->cantidad_mp*$pedplat->cantidad)}} 
                                      @endif

                                    @endforeach
                                  @endforeach
                               @endforeach
                              @endforeach
                            @endforeach 
              
                        <td>
            <!---muestro los empaques -->
            {{ ''; $i=0; }}
              @foreach(Empaques::where('materia_prima','=',$mat->id)->get() as $emp) <!---muestro los empaques que incluyan las materias primas del pedido -->            
                  @foreach(EmpaquesMp::where('empaques_id','=',$emp->id)->orderBy('cantidad', 'desc')->get() as $empmp)
                  {{ ''; $cant=($total - ($total%$empmp->cantidad)) / $empmp->cantidad;}}
                  @if($total>0 && $cant>0 ) 
                   {{''; $vcantidad[$i]=$empmp->cantidad; $vprecio[$i]=$empmp->precio; $vcant[$i]=$cant;$vid[$i]=$empmp->id; $i++;}}
                  @endif
                  {{ ''; $total=$total%$empmp->cantidad; }}
                @endforeach 
              @endforeach
              
                   <?php for($j=0; $j<$i; $j++){ ?>
                  
                  @if($vid[$j]==$empmp->id)
                    @if($total>0)
                    {{$vcantidad[$j]}} {{$mat->Unidades->nombre}}<br>
                    @else
                    {{$vcantidad[$j]}} {{$mat->Unidades->nombre}}<br>
                    @endif
                  @else
                  {{$vcantidad[$j]}} {{$mat->Unidades->nombre}}<br>
                  @endif
                  
                  <?php  }  ?>
      
      
                  @if($total>0)       
                    {{'';$sobrante=$empmp->cantidad-$total}}
                    @if($cant<=0)
                    {{$empmp->cantidad}} {{$mat->Unidades->nombre}}
                    @endif 
                  @endif

                        </td>

                        <td align="center">
                            
              <?php for($j=0; $j<$i; $j++){ ?>
                                
                                @if($vid[$j]==$empmp->id)
                  
                  @if($total>0)
                  {{$vcant[$j]+1}}<br>
                  @else
                  {{$vcant[$j]}}<br>
                  @endif
                  
                @else
                  {{$vcant[$j]}}<br>
                                @endif
                              
                                <?php  }  ?>

                                @if($total>0) 
                  @if($cant<=0) 
                    1 
                  @endif
                @endif
                
                        </td>
                  
                        <td>
            
              <?php for($j=0; $j<$i; $j++){ ?>
              
              @if($vid[$j]==$empmp->id)
                @if($total>0)
                ${{($vcant[$j]+1)*$vprecio[$j]}}<br>
                @else
                ${{$vcant[$j]*$vprecio[$j]}}<br>
                @endif
              @else
              ${{$vcant[$j]*$vprecio[$j]}}<br>
              @endif
              
              <?php  }  ?>

              @if($total>0) 
                @if($cant<=0)
                  ${{$empmp->precio}}
                @endif 
              @endif
                
                        </td>

                                  {{ ''; $total =0; $cant=0; $precio =0;}}
                  @foreach($ordenpedido as $ord)
                    @foreach(Pedidos::where('id','=',$ord->id_pedido)->where('sucursal','=',$suc->id)->get() as $ped)
                    @foreach(Pedidosplat::where('id_pedido','=',$ped->id)->get() as $pedplat)
                      @foreach(Platillos::where('id','=',$pedplat->id_platillo)->get() as $plat)
                      @foreach(PlatillosMp::where('platillos_id','=',$plat->id)->get() as $platmp)

                        @if($mat->id==$platmp->materia_prima)
                        {{ ''; $total=$total+($platmp->cantidad_mp*$pedplat->cantidad)}} 
                        @endif

                      @endforeach
                      @endforeach
                     @endforeach
                    @endforeach
                  @endforeach 
                  
                      <td>
                <!---muestro los empaques -->
                
                @foreach(Empaques::where('materia_prima','=',$mat->id)->get() as $emp) <!---muestro los empaques que incluyan las materias primas del pedido -->          
                    @foreach(EmpaquesMp::where('empaques_id','=',$emp->id)->orderBy('cantidad', 'desc')->get() as $empmp)
                      {{ ''; $cant=($total - ($total%$empmp->cantidad)) / $empmp->cantidad;}}
                      
                      @if($total>0 && $cant>0) 
                       {{'';$precio=$precio+$cant*$empmp->precio}}
                      @endif
                      
                      {{ ''; $total=$total%$empmp->cantidad; }}
                      
                    @endforeach 
                    
                      @if($precio>0)                     
                        {{'';$preciototal=$preciototal+$precio}}
                      @endif
                      
                @endforeach
                       @if($total>0)
                         {{'';$precio=$precio+$empmp->precio;$preciototal=$preciototal+$empmp->precio}} 
                       @endif
                      
                      ${{$precio}}

                        </td>

                         <td>
                        @if($sobrante ==0)
                        -
                        @else
                        {{$sobrante}} {{$mat->Unidades->nombre}}
                        @endif
                        </td>
                        
                        </tr> 
                      
      @endif        
        @endforeach 
     <tr>
      <td colspan="5" align="right">Total</td>
      <td>{{$preciototal}} $$</td>  
        </tr> 
       @endforeach 
   </tbody>
</table>
</html>

