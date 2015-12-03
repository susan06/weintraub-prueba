@extends ('dashboard.layouts.default')

@section ('title')
 Ver - Orden
@stop
@section ('cssPage')
  {{HTML::style('assetss/css/vendors/x-editable/address.css')}}
  {{HTML::style('assetss/css/vendors/x-editable/select2.css')}}
  {{HTML::style('assetss/css/vendors/x-editable/typeahead.js-bootstrap.css')}}
  {{HTML::style('assetss/css/vendors/x-editable/demo-bs3.css')}}
  {{HTML::style('assetss/css/vendors/x-editable/select2-bootstrap.css')}}
  {{HTML::style('assetss/css/vendors/x-editable/bootstrap-editable.css')}}
@stop

@section('pagina')
  <h2>Datos De la Orden de Compra</h2>
@stop

@section ('contenido')
       
       <!--alert mensajes -->
            @if(Session::has('msg'))
            <div class="alert alert-{{ Session::get('class') }}">
              <button type="button" class="close" data-dismiss="alert">
                <i class="icon-remove"></i>
              </button>
              {{ Session::get('msg')}}
              <br/>
            </div>
            @endif
            <!--/.alert mensajes -->

<div class="row">
    <div class="col-md-6">  
      <fieldset>
          <legend>
            {{$orden->nombre}}
          </legend>
 
              <div class="form-group">
                <div class="col-md-12">
                 <h3>Por: {{$orden->Usuario->username}}</h3>
                 <h4></h4>
                </div>       
              </div>
      </fieldset>
    </div>
    

            <table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
          <thead>

            <tr>
              <th>Pedido</th>
              <th>Sucursal</th>
              <th>Platillo</th>
              <th>Unidades</th>
              <th>Materia Prima</th>
              <th>Cantidad (por platillo)</th>    
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
                       
                        <td >{{$ped->nombre}}</td>
                        <td >{{$ped->Sucursales->sucursal}}</td>
                       
                        <td >{{$plat->nombre}}</td>

                        <td >{{$pedplat->cantidad}}</td>

                        <td >{{$materia->nombre}}</td>
                        <td >{{$platmp->cantidad_mp}} {{$materia->Unidades->nombre}}</td>
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
      Compra General
    </legend>
  <table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
    {{'';$preciototal =0;}}
          <thead>
            <tr></tr>
            <tr>

              <th>Materia Prima</th>
              <th>Cantidad Necesaria</th>
              <th>Empaque</th>
              <th>Proveedor</th>
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
            <!--muestro los empaques -->
            {{ ''; $i=0; }}
            @foreach(Empaques::where('materia_prima','=',$mat->id)->get() as $emp) 
                <!---muestro los empaques que incluyan las materias primas del pedido -->
                  @foreach(EmpaquesMp::where('empaques_id','=',$emp->id)->orderBy('cantidad', 'desc')->get() as $empmp)
                        {{ ''; $cant=($total - ($total%$empmp->cantidad)) / $empmp->cantidad;}}
                                               
                        {{ ''; $vproveedor[$i]='---'}}
                        @if($empmp->proveedor>0)                      
                        {{ ''; $vproveedor[$i]=$empmp->Proveedores->nombre}}
                        @endif

                        @if($total>0) 
                        @if($cant>0)

                        {{''; $vcantidad[$i]=$empmp->cantidad;$vcantidad[$i]=$empmp->cantidad; $vprecio[$i]=$empmp->precio; $vcant[$i]=$cant;$vid[$i]=$empmp->id; $i++;}}
                                                
                        @endif
                        @endif
                        {{ ''; $total=$total%$empmp->cantidad; }}
                  @endforeach 
            @endforeach
                        <?php for($j=0; $j<$i; $j++){ ?>
                        
                        @if($vid[$j]==$empmp->id)
                        @if($total>0)
                        {{$vcantidad[$j]}}{{$mat->Unidades->nombre}}<br>
                        @else
                        {{$vcantidad[$j]}}{{$mat->Unidades->nombre}}<br>
                        @endif
                        @else
                        {{$vcantidad[$j]}}{{$mat->Unidades->nombre}}<br>
                        @endif
                      
                        <?php  }  ?>

                        @if($total>0) {{'';$sobrante=$empmp->cantidad-$total}} @if($cant<=0){{$empmp->cantidad}}{{$mat->Unidades->nombre}}@endif @endif
                        

                        </td>


                        <td >
                <!---muestro los proveedores -->
                        <?php for($j=0; $j<$i; $j++){ ?>
                        
                        @if($vid[$j]==$empmp->id)
                        @if($total>0)
                        {{$vproveedor[$j]}}<br>
                        @else
                        {{$vproveedor[$j]}}<br>
                        @endif
                        @else
                        {{$vproveedor[$j]}}<br>
                        @endif
                      
                        <?php  }  ?>

                        @if($total>0) @if($cant<=0) {{$vproveedor[$j]}} @endif @endif
                        

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
        <td colspan="6" align="right"> 
          Total
        </td>
        <td>
          {{$preciototal}}$$
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
              <th>Proveedor</th>
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

                        {{ ''; $proveedor[$i]='---'}}
                        @if($empmp->proveedor>0)                      
                        {{ ''; $proveedor[$i]=$empmp->Proveedores->nombre}}
                        @endif

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
                        {{$vcantidad[$j]}}{{$mat->Unidades->nombre}}<br>
                        @else
                        {{$vcantidad[$j]}}{{$mat->Unidades->nombre}}<br>
                        @endif
                        @else
                        {{$vcantidad[$j]}}{{$mat->Unidades->nombre}}<br>
                        @endif
                      
                        <?php  }  ?>

                        @if($total>0) {{'';$sobrante=$empmp->cantidad-$total}} @if($cant<=0){{$empmp->cantidad}}{{$mat->Unidades->nombre}}@endif @endif

                        </td>

                         <td >
                           <!---muestro los proveedores -->
                        <?php for($j=0; $j<$i; $j++){ ?>
                        
                        @if($vid[$j]==$empmp->id)
                        @if($total>0)
                        {{$proveedor[$j]}}<br>
                        @else
                        {{$proveedor[$j]}}<br>
                        @endif
                        @else
                        {{$proveedor[$j]}}<br>
                        @endif
                      
                        <?php  }  ?>

                        @if($total>0) @if($cant<=0) {{$proveedor[$j]}} @endif @endif
                                              
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
        <td colspan="6" align="right"> 
          Total
        </td>
        <td>
          {{$preciototal}}$$
        </td>  
        </tr> 
           
                  </tbody>
        </table>
      <br> 

      @endforeach   
  </fieldset>
  <div class="form-group">  
    <div class="col-md-12">
      @if($valor==1)
      <a href="javascript:history.back()" class="btn btn-wide btn-success pull-right"><i class="fa fa-arrow-left"></i> Regresar </a>
      @else
      <a href="{{URL::route('see.orden')}}" class="btn btn-wide btn-success pull-right"><i class="fa fa-arrow-left"></i> Regresar </a>
      @endif
      <a href="{{ URL::to('dashboard/orden/show/excel/'.$orden->id)}}" class="btn btn-wide btn-success pull-right"><i class="fa fa-file"></i> Ver Excel </a>
    </div>
  </div>
                          
@stop
@section('js')
@stop
