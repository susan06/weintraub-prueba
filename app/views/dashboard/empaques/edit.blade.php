@extends ('dashboard.layouts.default')

@section ('title')
  Editar Empaques
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
  <h2>Editar Empaque</h2>
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
            Agregar Empaque
          </legend>
        <div class="form-group">  
                <div class="col-md-10" align="left">
                  <form method="post" action="{{URL::route('add.empaques')}}" class="form-horizontal">
                  <input name="_token" type="hidden" value="{{csrf_token()}}">
                  <style type="text/css">#materia{ height: 30px;} </style>
                  <input type="hidden" name="empaque"   value="{{$empaques->id}}" >
                  <input type="text" name="nombre" placeholder="Nombre" >
                  <input type="number" min="1"  id="cantidad" required placeholder="Cantidad"  name="cantidad" style="margin-top:2%" >
                  <select id="unidad" required name="unidad" style="margin-top:2%">
                  <option selected value="{{$empaques->Materias->Unidades->id}}">{{$empaques->Materias->Unidades->nombre}} ({{$empaques->Materias->Unidades->abreviatura}})</option>
                  </select>
                 <input type="number" min="1" step="any"  id="precio" required placeholder="Precio"  name="precio" style="margin-top:2%" >
                  <select id="proveedor" required name="proveedor" style="margin-top:2%">
                  <option hidden=""  value=""> Proveedor </option>
                  
                  @foreach($proveedores as $proveedor)
                  <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                  @endforeach
                  </select>

                  <button title="Guardar" class="btn btn-primary"><i class="ti-plus"></i>Añadir</button>
                  </form>
                 <br> 
                  
                </div>
                    </div>
         </fieldset>               

<form method="post" action="{{ URL::to('dashboard/empaques/'.$empaques->id.'/edit/') }}" class="form-horizontal">
  <input name="_token" type="hidden" value="{{csrf_token()}}">
  <div class="row">
    <div class="col-md-5">  
      <fieldset>
          <legend>
           Empaque
          </legend>
              Materia Prima
              <div class="form-group">
                
                <div class="col-md-8">
                  
                  <select onchange="getUnidad(this.value, 2);"  id="materia" name="materia" required style="margin-top:2%" >
                    <option value="{{$empaques->materia_prima}}">{{$empaques->Materias->nombre}}</option>
                    @foreach($materias as $materia)
                    <option value="{{$materia->id}}" @if($materia->id==$empaques->materia_prima) selected @endif>{{$materia->nombre}}</option>
                    @endforeach
                  </select>
                  @if ($empaques->Materias->Unidades->id > 0)
                  <select id="unidad2" required name="unidad2" style="margin-top:2%">
                  <option selected value="{{$empaques->Materias->Unidades->id}}">{{$empaques->Materias->Unidades->nombre}} ({{$empaques->Materias->Unidades->abreviatura}})</option>
                  </select>
                  @else
                  <select id="unidad2" required name="unidad2" disabled style="margin-top:2%">
                  </select>
                  @endif

                </div>       
              </div>

              
      </fieldset>
    </div>
    <div class="col-md-18">

      <fieldset>   
          <legend>
            Empaque - Cantidad
          </legend>
             <div class="form-group">  
                <div class="col-md-12" align="left">
                  <style type="text/css">#materia{ height: 30px;} </style>
                   <table  class="table table-hover">
                          <thead>
                            <tr>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Proveedor</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                         </tr></thead>

               <tbody>   
                @foreach($listaempaquesmp as $emp)
                <tr>
                <td>{{$emp->nombre}}</td> 
                <td>{{$emp->cantidad}} {{$empaques->Materias->Unidades->nombre}} ({{$empaques->Materias->Unidades->abreviatura}})</td>
                <td >@if($emp->precio !=null) {{number_format ( $emp->precio, 2, "," , "." )}}$ @endif</td>
                <td>@if($emp->proveedor !=null) {{$emp->Proveedores->nombre}} @endif</td>
                <td width=" 2%" align="center"> <a  href="{{ URL::to('dashboard/empaques/editar/'.$emp->id) }}"  class="btn bnt-wide btn-yellow"><i class="fa fa-pencil"></i></a></td>
                <td width=" 2%" align="center"><a  onclick="return confirmar('accion.html')" href="{{ URL::to('dashboard/empaques/borrar/'.$emp->id) }}" class="btn bnt-wide btn-red"><i class="fa fa-trash-o"></i></a></td>
                </tr>
                @endforeach
                  </tbody> 
                 </table>
                </div>
                </div>              
      </fieldset>
  <div class="form-group" align="center" >  
  <div class="col-md-12">
   <a href="{{URL::route('see.empaques')}}" class="btn btn-wide btn-success pull-right"> Regresar </a>
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

function getUnidad (valor, div) { 
  var seccion= div;
  if(seccion == 1){
    $('#unidad').empty(); 
    $('#unidad').append($('<option></option>').text('Cargando....').val(''));
                  $.get("{{ URL::route('empaque.unidad')}}",
                      { eleccion:valor},
                      function(data) {    
                          $('#add').removeAttr("disabled");
                          $('#unidad').empty();      
                          $.each(data, function(i) {
                          
                          $('#unidad').append("<option value='" + data[i].id + "'>" + data[i].nombre +" ("+ data[i].abreviatura + ")</option>");
                          
                          }); 
                         
                  }, "json");
  }else{
    $('#unidad2').empty(); 
    $('#unidad2').append($('<option></option>').text('Cargando....').val(''));
                  $.get("{{ URL::route('empaque.unidad')}}",
                      { eleccion:valor},
                      function(data) {    
                          $('#add2').removeAttr("disabled");
                          $('#unidad2').empty();      
                          $.each(data, function(i) {
                          
                          $('#unidad2').append("<option value='" + data[i].id + "'>" + data[i].nombre +" ("+ data[i].abreviatura + ")</option>");
                          
                          }); 
                         
                  }, "json");

  }


  } 

</script>

    
@stop