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
 <div class="row">
    <div class="col-md-5">  
      <fieldset>
          <legend>
            Platillo
          </legend>
              <div class="form-group">
                <div class="col-md-8">
                  @foreach($cat = Platillos::where('id','=',$platillosmps->platillos_id)->select('nombre as nombre')->get() as $category)
                  <h4>{{$category->nombre}}</h4>
              @endforeach
                </div>       
              </div>
      </fieldset>
    </div>

 <fieldset>
        <legend>
           Editar Materia Prima
          </legend>
        <div class="form-group">  
                <div class="col-md-12" align="left">
                  <form method="post" action="{{ URL::to('dashboard/platillos/'.$platillosmps->id.'/editar/') }}" class="form-horizontal">
                  <input name="_token" type="hidden" value="{{csrf_token()}}">
                  <style type="text/css">#materia{ height: 30px; width: 160px} </style>
                  <input type="hidden" name="platillos_id"   >
                  <select onchange="activar(this.value)" id="materia" name="materia"  style="margin-top:2%" >
                       @if(count($materias) > 0)
                      @foreach(Materias::where('id','=',$platillosmps->materia_prima)->get() as $muestra)
                   <option  value="{{$muestra->id}}" hidden="">{{$muestra->nombre}}</option>@endforeach
                    @foreach($materias as $materia)
                    <option value="{{$materia->id}}">{{$materia->nombre}}</option>
                    @endforeach
                    @else
                    <option value="">No hay materias primas registradas...</option>
                    @endif
                  </select>
                  <input type="number" min="0"  id="cantidad_materia" style="margin-top:2%"  name="cantidadm" placeholder="Cantidad"  value="{{$platillosmps->cantidad_mp}}">
                  <button title="Guardar" class="btn btn-primary">Actualizar</button>
                 <br><br> <br> 
               </form>
                        <table  class="table table-hover">
                          <thead>
                            <tr>
                            <th>Materias Primas</th>
                            <th>Cantidades</th>
                            <th>Editar</th>
                         </tr></thead>

               <tbody>   
                @foreach(PlatillosMp::where('platillos_id','=',$platillosmps->platillos_id)->get() as $category)
                @foreach(Materias::where('id','=',$category->materia_prima)->select('nombre as nombre')->get() as $muestra)
                <tr><td>{{$muestra->nombre}}</td> @endforeach
                <td>{{$category->cantidad_mp}} @if($category->Materias->Unidades->id >0) {{$category->Materias->Unidades->nombre}} @endif</td>
                <td width=" 2%" align="center"><a  href="{{ URL::to('dashboard/platillos/editar/'.$category->id) }}"  class="btn bnt-wide btn-yellow"><i class="fa fa-pencil"></i></a></td>
                 </tr>
                  @endforeach
                 </tbody> 
                 </table>
                 <br> 
                
                 <br> 
                  
                </div>
                    </div>
         </fieldset>               

    <div class="col-md-18">

  <div class="form-group" align="center" >  
  <div class="col-md-12">
    @foreach($cat = Platillos::where('id','=',$platillosmps->platillos_id)->select('id as id')->get() as $category)
      <a  href="{{ URL::to('dashboard/platillos/edit/'.$category->id) }}"   class="btn btn-wide btn-success pull-right">Regresar</a>
       @endforeach
  </div>
</div>
</div>
  </div>



@stop

@section('js')
<script>
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