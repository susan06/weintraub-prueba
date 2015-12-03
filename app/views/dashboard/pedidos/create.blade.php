@extends ('dashboard.layouts.default')

@section ('title')
  Agregar Pedido
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
  <h2>Agregar Pedido</h2>
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
            Pedido
          </legend>
          <div class="form-group">
            <div class="col-md-12">
              <label class="control-label">Nombre</label>
              <input type="text" required name="nombre" placeholder="Nombre" class="form-control" value="{{Input::old('nombre')}}"><br>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <label class="control-label">Responsable</label>
              <input type="text" required name="responsable" placeholder="Responsable" class="form-control" value="{{ Auth::user()->username}}" readonly><br>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12">
                  <label class="control-label">Sucursal</label>
                  @if(count($sucursales)>0)
                    <select class="form-control" required name="sucursal">
                    <option value="">Seleccione la Sucursal</option>
                    @foreach ($sucursales as $sucursal)
                    <option value="{{$sucursal->id}}" @if(Input::old('sucursal') == $sucursal->id) selected @endif > {{$sucursal->sucursal}}</option>
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
                  <input name="fecha" type="text" required class="form-control" placeholder="Fecha de entrega" value="{{Input::old('fecha')}}"/>
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default">
                    <i class="glyphicon glyphicon-calendar"></i>
                  </button> </span>
                  </p>
                </div>
          </div>
          

      </fieldset>
    </div>
    <div class="col-md-6">
      <fieldset>
          <legend>
           Añadir platillo
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
    <a href="{{URL::route('see.pedidos')}}" class="btn btn-wide btn-success pull-right">Regresar</a>

    <button type="submit" id="" name="" class="btn btn-wide btn-primary pull-right">Guardar</button>
  </div>
 <a href="{{URL::route('create.platillos')}}" class="btn btn-wide btn-primary pull-left">Agregar Platillo</a>
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
			
			var sele = document.createElement('select');
      var identificador= 'subcategorias'+sub_cero;
        sele.name = 'subcategorias[]'; 
        sele.id = identificador;
        sele.required = 'required'; 
        sele.className = 'form-control';
        
        $('#'+identificador).append($('<option></option>').text('Cargando....').val(''));
                $.get("{{ URL::route('plat.pedidos')}}",
                    { eleccion:0},
                    function(data) {    
                        $('#'+identificador).empty();      
                        $('#'+identificador).append($('<option></option>').text('Seleccione su Platillo').val(''));            
                        $.each(data, function(i) {
                        
                        $('#'+identificador).append("<option value='" + data[i].id + "'>" + data[i].nombre + "</option>");
                        
                        }); 
                       
                }, "json");

      var input2       = document.createElement("input");
        input2.type    = 'number';
        input2.min     = '1';     
        input2.name    = 'subcategorias2[]';
        input2.placeholder    = 'Cantidad';
        input2.required = 'required';
        input2.className = 'form-control';
        input2.size    =30;  			

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

</script>

    
@stop