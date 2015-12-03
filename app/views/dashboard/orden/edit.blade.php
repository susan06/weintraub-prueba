@extends ('dashboard.layouts.default')

@section ('title')
  Editar Orden
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
  <h2>Editar Orden</h2>
@stop

@section ('contenido')
       
               
            <!--PAGE CONTENT BEGINS-->

            <!---alert mensajes --->
            @if(Session::has('msg'))
            <div class="alert alert-{{ Session::get('class') }}">
              <button type="button" class="close" data-dismiss="alert">
                <i class="icon-remove"></i>
              </button>
              {{ Session::get('msg')}}
              <br/>
            </div>
            @endif
            
            <div class="alert alert-error" id="alert" style="display:none">
              <button type="button" class="close" data-dismiss="alert">
                <i class="icon-remove"></i>
              </button>
                Los cambios no fueron realizados, intente de nuevo
              <br/>
            </div>
            <!---/.alert mensajes -->

 <fieldset>
        <legend>
            Agregar Pedido
          </legend>
        <div class="form-group">  
                <div class="col-md-10" align="left">
                  <form method="post" action="{{URL::route('add.pedidos.orden')}}" class="form-horizontal">
                  <input name="_token" type="hidden" value="{{csrf_token()}}">
                  <style type="text/css">#materia{ height: 30px;} </style>
                  <input type="hidden" name="orden"   value="{{$orden->id}}" >
                  <select  id="pedido" name="pedido" required style="margin-top:2%" >
                   
                    <option value="" hidden="">Seleccione un Pedido...</option>
                    @foreach($pedidos as $pedido)
                    <option value="{{$pedido->id}}">{{$pedido->nombre}}</option>
                    @endforeach
                  
                  </select>
                
                 <button title="Guardar" class="btn btn-primary"><i class="ti-plus"></i>Añadir</button>
                 </form>
                 <br> 
                  
                </div>
                    </div>
         </fieldset>               

<form method="post" action="{{ URL::to('dashboard/orden/'.$orden->id.'/edit/') }}" class="form-horizontal">
  <input name="_token" type="hidden" value="{{csrf_token()}}">
  <div class="row">
    <div class="col-md-5">  
      <fieldset>
          <legend>
            Orden
          </legend>
              <div class="form-group">
               <div class="col-md-12">
                  <label class="control-label">Nombre</label>
                  <input type="text" required name="nombre" placeholder="Nombre" class="form-control" value="{{$orden->nombre}}"><br>
                </div>
              </div>              
                                 
             
              <div class="form-group">
                <div class="col-md-10">
                Orden creada el: {{strftime("%d-%m-%Y",strtotime($orden->created_at))}}
                </div>
          </div>

              
               <input type="hidden"  class="form-control" name="responsable" id="Responsable" value="{{$orden->responsable}}">
      </fieldset>
    </div>
    <div class="col-md-18">

      <fieldset>   
          <legend>
            Pedidos
          </legend>
             <div class="form-group">  
                <div class="col-md-12" align="left">
                  <style type="text/css">#materia{ height: 30px;} </style>
                   <table  class="table table-hover">
                          <thead>
                            <tr>
                            <th>Pedido</th>
                            <th>Sucursal</th>
                            
                            
                            <th>Eliminar</th>
                         </tr></thead>

               <tbody>   
                @foreach($ordenpedido as $ordp)
                <tr>
                <td>{{$ordp->Pedidos->nombre}}</td> 
                <td>@if($ordp->Pedidos->Sucursales->sucursal !=null){{$ordp->Pedidos->Sucursales->sucursal}} @endif</td> 
               
               
                <td width=" 2%" align="center"><a  onclick="return confirmar('accion.html')" href="{{ URL::to('dashboard/orden/borrar/'.$ordp->id) }}" class="btn bnt-wide btn-red"><i class="fa fa-trash-o"></i></a></td>
                </tr>
                @endforeach
                  </tbody> 
                 </table>
                </div>
                </div>              
      </fieldset>
  <div class="form-group" align="center" >  
  <div class="col-md-12">
   <a href="{{URL::route('see.orden')}}" class="btn btn-wide btn-success pull-right"> Regresar </a>
  <button type="submit" class="btn btn-wide btn-primary pull-right">Guardar</button>
  </div>
</div>
</div>
  </div>
</form>


@stop

@section('js')
<script>
function confirmar(url)
{
  if(confirm('¿Esta seguro de eliminar este registro?'))
  {
    window.location=url;
  }
  else
  {
    return false;
  } 
}

</script>

    
@stop