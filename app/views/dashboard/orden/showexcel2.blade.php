<html>
<body>
Datos De la Orden de Compra:;{{$orden->nombre}}
      <div>
        <div>  
          <fieldset>
            <legend>
              Responsable: <b>{{$orden->Usuario->username}}</b>
            </legend>
            <legend>
              Fecha: <b>{{$orden->created_at}}</b>
            </legend>
        <div>
      <div>
              <h3>Materia prima necesaria por platillo</h3>
          </fieldset>
          </div>          
          <table>
                <thead>
            <tr>
              <th align="left">Pedido</th>
              <th align="left">Sucursal</th>
              <th align="left">Platillo</th>
              <th align="left">Unidades</th>
              <th align="left">Materia Prima</th>
              <th align="left">Cantidad (por platillo)</th>    
            </tr>
          </thead>
          <tbody>
            @foreach($ordenpedido as $ord)
              @foreach(Pedidos::where('id','=',$ord->id_pedido)->get() as $ped)
                @foreach(Pedidosplat::where('id_pedido','=',$ped->id)->get() as $pedplat)
                  @foreach(Platillos::where('id','=',$pedplat->id_platillo)->get() as $plat)
                    @foreach(PlatillosMp::where('platillos_id','=',$plat->id)->get() as $platmp)
                      @foreach(Materias::where('id','=',$platmp->materia_prima)->get() as $materia)
                        <tr>
                       <td align="left">{{$ped->nombre}}</td>
                        <td align="left">{{$ped->Sucursales->sucursal}}</td>
                       <td align="left">{{$plat->nombre}}</td>
                        <td align="left">{{$pedplat->cantidad}}</td>
                        <td align="left">{{$materia->nombre}}</td>
                        <td align="left">{{$platmp->cantidad_mp}} {{$materia->Unidades->nombre}}</td>
                        </tr> 
                      @endforeach
                    @endforeach
                  @endforeach
               @endforeach
              @endforeach
            @endforeach     
            </tbody>
        </table>
            <br>  
        <fieldset>
        <legend>
             <h3>Orden de Compra General</h3>
          </legend>
               <table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
    {{'';$preciototal =0;}}
          <thead>
            <tr></tr>
            <tr>

              <th>Materia Prima</th>
              <th>Cantidad Necesaria</th>
              <th>Empaque</th>
              <th>Cantidad</th>
              <th>Costo</th>
               <th>Costo total</th>
               <th>Sobrante</th>
                 
            </tr>
          </thead>
          <tbody>
          @foreach($materiasall as $mat)
           
                      

                        <tr>
                       
                        <td >

                          {{$mat->nombre}}

                        </td>
                        
                       
                        <td >
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
              <td >
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

                        </td >

                        <td>
                        @if($sobrante ==0)
                        -
                        @else
                        {{$sobrante}} {{$mat->Unidades->nombre}}
                        @endif
                        </td >
                        
                        </tr> 
                      
                    
        @endforeach 
        <tr>
        <td colspan="5" align="right"> 
          Total
        </td>
        <td>
          {{$preciototal}} $$
        </td>  
        </tr> 
            
          </tbody>
        </table>
      <br>    
    </fieldset>
    <fieldset>
    <legend>
      Compra Detallada
    </legend>  
       @foreach($sucursales as $suc)

      <table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
        {{'';$preciototal =0;}}
          <thead>
            <tr>Sucursal: <h4>{{$suc->sucursal}}</h4></tr>
            <tr>

               <th>Materia Prima</th>
               <th>Cantidad Necesaria</th>
              <th>Empaque</th>
              <th>Cantidad</th>
              <th>Costo</th>
               <th>Costo total</th>
               <th>Sobrante</th>
                 
            </tr>
          </thead>
            
          <tbody>

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
                       
                        <td >

                          {{$mat->nombre}}

                        </td>
                        
                       
                        <td >
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
              <td >
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
                        </td >
                        
                        </tr> 
                      
        @endif        
        @endforeach 
         <tr>
        <td colspan="5" align="right"> 
          Total
        </td>
        <td>
          {{$preciototal}} $$
        </td>  
        </tr> 
           
                  </tbody>
        </table>
      <br> 
          @endforeach   
      </fieldset>
</body>
</html>                                    
