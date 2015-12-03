@extends ('dashboard.layouts.default')

@section ('title')
  Editar Proveedores
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
  <h2>Editar Proveedores</h2>
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

<form method="post" action="{{ URL::to('dashboard/proveedores/'.$proveedores->id.'/edit/') }}" class="form-horizontal">
  <input name="_token" type="hidden" value="{{csrf_token()}}">
   
      <fieldset>
      <legend>
        Datos del Proveedor
      </legend>
        <div class="form-group">
            <div class="col-md-4">
              <label class="control-label">Nombre</label>
              <input type="text" pattern="|^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ1234567890]*$|" maxlength="15" title="No se Admiten espacios ni caracteres especiales" required name="nombre" placeholder="Ingresar Nombre" class="form-control" value="{{$proveedores->nombre}}" ><br>
            </div>
            
            <div class="col-sm-4">
                <label class="control-label" for=""> Empresa</label>
                  <input type="text" required name="empresa" placeholder="Ingresar Empresa" class="form-control" value="{{$proveedores->empresa}}"><br>
            </div>

            <div class="col-md-4">
              <label class="control-label">Teléfono</label>
              <input type="text" required name="telefono" maxlength="10" min="10" max="9999999999" placeholder="Ingresar Teléfono" class="form-control" value="{{$proveedores->telefono}}" ><br>
            </div>
            
            <div class="col-sm-4">
                <label class="control-label" for=""> Dirección</label>
                  <input type="text" required name="direccion" placeholder="Ingresar Dirección" class="form-control" value="{{$proveedores->direccion}}"><br>
            </div>

            <div class="col-md-4">
              <label class="control-label">Notas</label>
              <input type="text" required name="notas" placeholder="Ingresar Notas" class="form-control" value="{{$proveedores->notas}}" ><br>
            </div>      
        </div>
      </fieldset>      
     
      <div class="form-group">
        <div class="col-sm-11">
          <div class="form-group" align="right">  
            <a onclick="document.location.href = '{{ URL::route('see.proveedores') }}'" class="btn btn-wide btn-success pull-right">Regresar</a>
            <button type="submit" name="" class="btn btn-wide btn-primary pull-right">Guardar</button>  
          </div>
        </div>
      </div>
      
    
</form>

@stop

@section('js')

   
@stop