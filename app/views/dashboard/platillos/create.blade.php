@extends ('dashboard.layouts.default')

@section ('title')
  Agregar Platillo
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
  <h2>Agregar Platillo</h2>
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
            Platillo
          </legend>
              <div class="form-group">
                <div class="col-md-12">
                  Nombre del Platillo
                  <input class="form-control" name="nombre" id="Nombre" required>
                </div>       
              </div>

      </fieldset>
    </div>
    <div class="col-md-6">
      <fieldset>
          <legend>
            Materia Prima - Cantidad
          </legend>
             <div class="form-group">  
                <div class="col-md-2" align="left">
                  <button type="button" onclick="addSub()" class="btn btn-success"><i class="fa fa-plus"></i> Agregar </button>

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
   <a href="{{URL::route('see.platillos')}}" class="btn btn-wide btn-success pull-right"> Regresar </a>

    <button type="submit" id="" name="" class="btn btn-wide btn-primary pull-right">Guardar</button>
  </div>
  <a href="{{URL::route('create.materias')}}" class="btn btn-wide btn-primary pull-left">Agregar Materia Prima</a>
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
	
	addSub = function () { 
		
		//si se agrega una subcategoria el input id="content_sub" cambia a 1
		document.getElementById("count_sub").value = 1;
		sub_cero = ++num_sub;
		
	var container = document.getElementById('content_sub');
		
		var div  		= document.createElement("div");
		div.className   = 'form-inline';
		div.style.marginBottom = "2%";
			
			var input  			= document.createElement("input");
       
				input.type		= 'text';	
        input.name		= 'subcategorias[]';
        input.placeholder    = 'Materia Prima';
				input.className	= 'form-control';
        input.size    =20;   

      var sele = document.createElement('select');
      var identificador= 'subcategorias'+sub_cero;
        sele.name = 'subcategorias[]'; 
        sele.id = identificador; 
        sele.className = 'form-control';

       

             
        $('#'+identificador).append($('<option></option>').text('Cargando....').val(''));
                $.get("{{ URL::route('mat.platillos')}}",
                    { eleccion:0},
                    function(data) {    
                        var ident= sub_cero;
                        $('#'+identificador).attr('required', 'required');
                        $('#'+identificador).attr('onchange', "getUnidad("+ident+", this.value);");
                        $('#'+ident).attr('required', 'required');
                        $('#'+identificador).empty();      
                        $('#'+identificador).append($('<option></option>').text('Seleccione la Materia').val(''));            
                        $.each(data, function(i) {
                        
                        $('#'+identificador).append("<option value='" + data[i].id + "'>" + data[i].nombre + "</option>");
                        
                        }); 
                       
                }, "json");
        
       


      var input2       = document.createElement("input");
      var ident= 'subcategoria'+sub_cero;
         
        input2.id      = ident;
        input2.type    = 'number';
        input2.min     = '1'; 
        input2.name    = 'subcategorias2[]';
        input2.required    ='required';
        
        input2.className = 'form-control';
        input2.size    =20; 

     	var a				= document.createElement('i');
				a.style.cursor	= 'pointer';
				a.className		= 'fa fa-trash-o btn bnt-wide btn-red';
				a.style.marginLeft = "2%";
				a.onclick		= function() { 
									this.parentNode.parentNode.removeChild(this.parentNode); 
									sub_cero= --num_sub;
									if(sub_cero == 0) {
									  document.getElementById("count_sub").value = 0;
									}
								};			
    

		div.appendChild(sele);
    div.appendChild(input2);
    
		div.appendChild(a);
	container.appendChild(div);

}

function getUnidad(id, materia){
    
    $.get("{{ URL::route('mat.unidades')}}",
                    { eleccion:materia},
                    
                    function(data) {    
                                                         
                        $.each(data, function(i) {
                        
                        $('#subcategoria'+id).attr('placeholder', 'Cantidad en '+data[i].nombre);
                        
                        }); 
                       
                }, "json");

    

    }


</script>

    
@stop