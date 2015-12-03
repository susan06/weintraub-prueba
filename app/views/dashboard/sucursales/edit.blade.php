@extends ('dashboard.layouts.default')

@section ('title')
  Editar Sucursal
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
  <h2>Editar Sucursal</h2>
@stop

@section ('contenido')
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

		<form method="post" action="{{ URL::to('dashboard/sucursales/'.$sucursales->id.'/edit/') }}" class="form-horizontal">
		  <input name="_token" type="hidden" value="{{csrf_token()}}">
		   
			  <fieldset>
			  <legend>
				Sucursal
			  </legend>
				<div class="form-group">
				  <div class="col-md-4">           
					<input type="text" required name="sucursal" placeholder="Ingresa Sucursal" value="{{$sucursales->sucursal}}" class="form-control" ><br>
				  </div>               
				</div>
			  </fieldset>      
			 
			  <div class="form-group">
				<div class="col-sm-11">
				  <div class="form-group" align="right">  
					<a onclick="document.location.href = '{{ URL::route('see.sucursales') }}'" class="btn btn-wide btn-success pull-right">Regresar</a>
					<button type="submit" name="" class="btn btn-wide btn-primary pull-right">Guardar</button>  
				  </div>
				</div>
			  </div>
		 
		</form>

@stop

