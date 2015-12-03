@extends ('dashboard.layouts.default')

@section ('title')
  Editar Pedido
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
  <h2>Editar Pedido</h2>
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
            Agregar Platillo
          </legend>
        <div class="form-group">  
                <div class="col-md-10" align="left">
                  <form method="post" action="{{URL::route('add.platillos.pedidos')}}" class="form-horizontal">
                  <input name="_token" type="hidden" value="{{csrf_token()}}">
                  <style type="text/css">#materia{ height: 30px;} </style>
                  <input type="hidden" name="pedido"   value="{{$pedidos->id}}" >
                  <select  id="platillo" name="platillo" required style="margin-top:2%" >
                   
                    <option value="" hidden="">Seleccione un platillo...</option>
                    @foreach($platillos as $platillo)
                    <option value="{{$platillo->id}}">{{$platillo->nombre}}</option>
                    @endforeach
                  
                  </select>
                  <input type="number" min="1"  id="cantidad" required placeholder="Cantidad"  name="cantidad" style="margin-top:2%" >
                 <button title="Guardar" class="btn btn-primary"><i class="ti-plus"></i>Añadir</button>
                 </form>
                 <br> 
                  
                </div>
                    </div>
         </fieldset>               

<form method="post" action="{{ URL::to('dashboard/pedidos/'.$pedidos->id.'/edit/') }}" class="form-horizontal">
  <input name="_token" type="hidden" value="{{csrf_token()}}">
  <div class="row">
    <div class="col-md-5">  
      <fieldset>
          <legend>
            Pedido
          </legend>
              <div class="form-group">
               <div class="col-md-12">
                  <label class="control-label">Nombre</label>
                  <input type="text" required name="nombre" placeholder="Nombre" class="form-control" value="{{$pedidos->nombre}}"><br>
                </div>
              </div>              
                                 
              <div class="form-group">
                <div class="col-md-12">
                      <label class="control-label">Sucursal</label>
                      @if(count($sucursales)>0)
                        <select class="form-control" required name="sucursal">
                        <option value="">Seleccione la Sucursal</option>
                        @foreach ($sucursales as $sucursal)
                        <option value="{{$sucursal->id}}" @if($sucursal->id==$pedidos->sucursal) selected @endif > {{$sucursal->sucursal}}</option>
                        @endforeach
                        </select>
                      @else
                        <select class="form-control" required name="sucursal">
                        <option value="" >No ha Agregado Sucursales</option>
                        </select>
                      @endif
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-10">
                  <label class="control-label">Fecha de Evento</label>
                  <p class="input-group input-append datepicker date">
                  <input name="fecha" required type="text" class="form-control" placeholder="Fecha de entrega" value="{{strftime("%m/%d/%Y",strtotime($pedidos->fecha_entrega))}}"/>
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default">
                    <i class="glyphicon glyphicon-calendar"></i>
                  </button> </span>
                  </p>
                </div>
          </div>

              <div class="form-group">
                <div class="col-md-10">
                  <label class="control-label">Fecha de Pedido:</label>
                  
                  {{strftime("%d-%m-%Y",strtotime($pedidos->created_at))}}
                  
                </div>
              </div>
               <input type="hidden"  class="form-control" name="responsable" id="Responsable" value="{{$pedidos->responsable}}">
      </fieldset>
    </div>
    <div class="col-md-18">

      <fieldset>   
          <legend>
            Platillo - Cantidad
          </legend>
             <div class="form-group">  
                <div class="col-md-12" align="left">
                  <style type="text/css">#materia{ height: 30px;} </style>
                   <table  class="table table-hover">
                          <thead>
                            <tr>
                            <th>Platillos</th>
                            <th>Cantidades</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                         </tr></thead>

               <tbody>   
                @foreach($listaplatillos as $lista)
                <tr>
                <td>{{$lista->Platillos->nombre}}</td> 
                <td>{{$lista->cantidad}}</td>
                <td width=" 2%" align="center"> <a  href="{{ URL::to('dashboard/pedidos/editar/'.$lista->id) }}"  class="btn bnt-wide btn-yellow"><i class="fa fa-pencil"></i></a></td>
                <td width=" 2%" align="center"><a  onclick="return confirmar('accion.html')" href="{{ URL::to('dashboard/pedidos/borrar/'.$lista->id) }}" class="btn bnt-wide btn-red"><i class="fa fa-trash-o"></i></a></td>
                </tr>
                @endforeach
                  </tbody> 
                 </table>
                </div>
                </div>              
      </fieldset>
  <div class="form-group" align="center" >  
  <div class="col-md-12">
   <a href="{{URL::route('see.pedidos')}}" class="btn btn-wide btn-success pull-right"> Regresar </a>
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