@extends ('dashboard.layouts.default')

@section ('title')
  Agregar Empaques
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
  <h2>Agregar Empaques</h2>
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

<form method="post" action="#" class="form-horizontal">
  <input name="_token" type="hidden" value="{{csrf_token()}}">
  
  <div class="row">
    <div class="col-md-6">  
      <fieldset>
          <legend>
            Empaques
          </legend>
              <div class="form-group">
                <div class="col-md-12">
                  Materia Prima
                <select onchange="getUnidad(this.value);" class="form-control" required name="nombre">
                   @if(count($materias) > 0)
                     <option value="" hidden="">Seleccionar Materia Prima</option>
                       @foreach($materias as $materia)
                         <option value="{{$materia->id}}">{{$materia->nombre}}</option>
                       @endforeach
                   @else
                     <option value="">No hay Materia Prima Disponible</option>
                   @endif
                </select>
                @if(count($materias) == 0)
                *Para agregar empaques en materias existentes vaya a empaques y seleccione la opcion editar en la materia prima correspondiente.
                @endif
                </div>       
              </div>

              <div class="form-group">
                <div class="col-md-12">
                  @if(count($materias) > 0)
                  Unidad
                  @endif
                 <select id="unidad" class="form-control" required name="nombre" disabled>
                 
                </select>
                </div>       
              </div>


              
      </fieldset>
    </div>
    <div class="col-md-6">
      <fieldset>
        <legend>
          Empaque - Cantidad
        </legend>
          <div class="form-group">  
            <div class="col-md-2" align="left">
              <button id="add" type="button" onclick="addSub()" class="btn btn-success" disabled><i class="fa fa-plus"></i> Agregar </button>

              <input name="count_sub" id="count_sub" type="hidden" value="0">
            </div>
          </div>
          <div id="content_sub">  

          </div>
      </fieldset>
    </div>
  </div>
  <div class="form-group" align="center" >  
    <div class="col-md-12">
      <a href="{{URL::route('see.empaques')}}" class="btn btn-wide btn-success pull-right"> Regresar </a>

      <button type="submit" id="" name="" class="btn btn-wide btn-primary pull-right">Guardar</button>
    </div>
    <!--<a href="{{URL::route('create.empaques')}}" class="btn btn-wide btn-primary pull-left">Agregar Materia Prima</a>-->
  </div>
</form>


@stop

@section('js')

<script type="text/javascript">

  var num_sub = 0
    var sub_cero = 0;

  evento = function (evt) {
  return (!evt) ? event : evt;
  }

  function getUnidad (valor) { 

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


  } 

  addSub = function () { 
    
    //si se agrega una subcategoria el input id="content_sub" cambia a 1
    document.getElementById("count_sub").value = 1;
    sub_cero = ++num_sub;
    
  var container = document.getElementById('content_sub');
    
    var div     = document.createElement("div");
    div.className   = 'form-inline';
    div.style.marginBottom = "2%";
      
      var input       = document.createElement("input");
        input.type    = 'text';     
        input.name    = 'subcategorias[]';
        input.placeholder    = 'Nombre';
        input.className = 'form-control';
        input.size    =20; 
        input.required    ='required';        


      var input2       = document.createElement("input");
        input2.type    = 'number'; 
        input2.min     = '1';     
        input2.name    = 'subcategorias2[]';
        input2.placeholder    = 'Cantidad';
        input2.className = 'form-control';
        input2.size    =20; 
        input2.required    ='required'; 

        var input3       = document.createElement("input");
        input3.type    = 'number'; 
        input3.step    ="any"
        input3.min     = '1';     
        input3.name    = 'subcategorias3[]';
        input3.placeholder    = 'Precio $';
        input3.className = 'form-control';
        input3.size    =20; 
        input3.required    ='required';  

        var sele = document.createElement('select');
        var identificador= 'subcategorias4'+sub_cero;
        sele.name = 'subcategorias4[]'; 
        sele.id = identificador;
        sele.required = 'required'; 
        sele.className = 'form-control';  

         $('#'+identificador).append($('<option></option>').text('Cargando....').val(''));
                $.get("{{ URL::route('sel.proveedores')}}",
                    { eleccion:0},
                    function(data) {    
                        $('#'+identificador).empty();      
                        $('#'+identificador).append($('<option></option>').text('Proveedor').val(''));            
                        $.each(data, function(i) {
                        
                        $('#'+identificador).append("<option value='" + data[i].id + "'>" + data[i].nombre + "</option>");
                        
                        }); 
                       
                }, "json");      

      var a       = document.createElement('i');
        a.style.cursor  = 'pointer';
        a.className   = 'fa fa-trash-o btn bnt-wide btn-red';
        a.style.marginLeft = "2%";
        a.onclick   = function() { 
                  this.parentNode.parentNode.removeChild(this.parentNode); 
                  sub_cero= --num_sub;
                  if(sub_cero == 0) {
                    document.getElementById("count_sub").value = 0;

       
                  }
                };      

    div.appendChild(input);
    div.appendChild(input2);
    div.appendChild(input3);
    div.appendChild(sele);
    div.appendChild(a);
  container.appendChild(div);

}

</script>



    
@stop