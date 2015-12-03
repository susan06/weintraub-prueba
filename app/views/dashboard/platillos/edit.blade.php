@extends ('dashboard.layouts.default')

@section ('title')
  Editar Platillo
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
  <h2>Editar Platillo</h2>
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
            Nueva Materia Prima
          </legend>
        <div class="form-group">  
                <div class="col-md-10" align="left">
                  <form method="post" action="{{URL::route('create.platillos.materias')}}" class="form-horizontal">
                  <input name="_token" type="hidden" value="{{csrf_token()}}">
                  <style type="text/css">#materia{ height: 30px;} </style>
                  <input type="hidden" name="platillos_id"   value="{{$platillos->id}}" >
                  <select onchange="activar(this.value)"  id="materia" name="materia" required style="margin-top:2%" >
                       @if(count($materias) > 0)
                    <option value="" hidden="">Seleccionar una materia prima...</option>
                    @foreach($materias as $materia)
                    <option value="{{$materia->id}}">{{$materia->nombre}}</option>
                    @endforeach
                    @else
                    <option value="">No hay materias registradas...</option>
                    @endif
                  </select>
                  <input type="number" min="1"  id="cantidad_materia" required placeholder="Cantidad"  name="cantidadm" style="margin-top:2%" >
                 <button id="add" title="Guardar" class="btn btn-primary" disabled><i class="ti-plus"></i>Añadir</button>
                 </form>
                 <br> 
                  
                </div>
                    </div>
         </fieldset>               

<form method="post" action="{{ URL::to('dashboard/platillos/'.$platillos->id.'/edit/') }}" class="form-horizontal">
  <input name="_token" type="hidden" value="{{csrf_token()}}">
  <div class="row">
    <div class="col-md-5">  
      <fieldset>
          <legend>
            Platillo
          </legend>
              <div class="form-group">
                <div class="col-md-8">
                  Nombre del Platillo
                  <input type="text"  class="form-control" name="platillo" id="platillo" value="{{$platillos->nombre}}">
                </div>       
              </div>
      </fieldset>
    </div>
    <div class="col-md-18">

      <fieldset>   
          <legend>
            Materia Prima - Cantidad
          </legend>
             <div class="form-group">  
                <div class="col-md-12" align="left">
                  <style type="text/css">#materia{ height: 30px;} </style>
                   <table  class="table table-hover">
                          <thead>
                            <tr>
                            <th>Materias Primas</th>
                            <th>Cantidades</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                         </tr></thead>

               <tbody>   
                  @foreach($platillosmp as $platillosmps)
                     @foreach(Materias::where('id','=',$platillosmps->materia_prima)->select('nombre as nombre')->get() as $muestra)
                <tr><td>{{$muestra->nombre}}</td> @endforeach
                <td>{{$platillosmps->cantidad_mp}} @if($platillosmps->Materias->Unidades->id >0) {{$platillosmps->Materias->Unidades->nombre}} @endif </td>
                <td width=" 2%" align="center"> <a  href="{{ URL::to('dashboard/platillos/editar/'.$platillosmps->id) }}"  class="btn bnt-wide btn-yellow"><i class="fa fa-pencil"></i></a></td>
                <td width=" 2%" align="center"><a  onclick="return confirmar('accion.html')" href="{{ URL::to('dashboard/platillos/destroy/'.$platillosmps->id) }}" class="btn bnt-wide btn-red"><i class="fa fa-trash-o"></i></a></td>
                </tr>
                   @endforeach
                  </tbody> 
                 </table>
                </div>
                </div>              
      </fieldset>
  <div class="form-group" align="center" >  
  <div class="col-md-12">
   <a href="{{URL::route('see.platillos')}}" class="btn btn-wide btn-success pull-right"> Regresar </a>
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

function activar(materia)
{
  $('#add').removeAttr("disabled");
  $('#cantidad_materia').removeAttr("placeholder");
  $('#cantidad_materia').attr('placeholder', 'Cargando unidad...');
  $.get("{{ URL::route('mat.unidades')}}",
                    { eleccion:materia},
                    
                    function(data) {    
                                                         
                        $.each(data, function(i) {
                        
                        $('#cantidad_materia').attr('placeholder', 'Cantidad en '+data[i].nombre);
                        
                        }); 
                       
                }, "json");

  
}
</script>

    
@stop