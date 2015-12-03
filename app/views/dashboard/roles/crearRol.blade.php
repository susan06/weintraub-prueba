@extends ('dashboard.layouts.default')

@section ('title')
	Crear Rol
@stop
@section ('css')
	
@stop

@section('pagina')
  <h2>Crear Rol</h2>
@stop
@section ('contenido')
    <div style="display:none;" class="progress progress-striped active" id="barra">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"          style="width: 100%;"> Procesando...
        </div>
      </div>

		
			<form action="" onsubmit="return false" class="form-inline">
				<label for="">
          <input type="text" id="rol" data-eliminar="{{URL::route('eliminarRol')}}" data-crear="{{URL::route('rol')}}" data-toggle="popover" class="form-control" placeholder="Nombre del nuevo rol" data-placement="bottom">
        </label>
				<label for="">
          <input type="button" class="btn btn-success" value="Crear" id="crear">
			 </label>
      </form>
	
    <!-- Alert -->
    <div style="display:none;" class="alert alert-warning alert-dismissible" role="alert">
      
     </div>
  <!-- end Alert -->

  <div id="cargarTabla">
  @if(count($roles) > 0)
  <table class="table table-bordered table-hover" >
        <tr>
          <th width="30%">Rol</th>
          <th>Opción</th>
        </tr>
        @foreach($roles as $rol)
        <tr>
             <td>{{$rol['name']}}</td>
             <td>
                <button  class="eliminar label label-danger" id="boton" name="{{$rol['id']}}"><i class="glyphicon glyphicon-remove"></i></button>
             </td>
           </tr>
        @endforeach
      </table>
      @else 
          <div style="display:block;" class="alert alert-warning alert-dismissible" role="alert">
            No sé a creado ningún rol aun  
          </div>
      @endif
      </div>



@stop
@section('js')
<!--Scripts--> 
<!--JQuery--> 
<script type="text/javascript" src="{{asset('assetss/js/vendors/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assetss/js/vendors/jquery/jquery-ui.min.js')}}"></script>

<!--Fullscreen--> 
<script type="text/javascript" src="{{asset('assetss/js/vendors/fullscreen/screenfull.min.js')}}"></script>

<!--NanoScroller--> 
<script type="text/javascript" src="{{asset('assetss/js/vendors/nanoscroller/jquery.nanoscroller.min.js')}}"></script>

<!--Sparkline--> 
<script type="text/javascript" src="{{asset('assetss/js/vendors/sparkline/jquery.sparkline.min.js')}}"></script>

<!--Horizontal Dropdown--> 

<script type="text/javascript" src="{{asset('assetss/js/vendors/classie/classie.js')}}"></script>

<!--Datatables--> 
<script type="text/javascript" src="{{asset('assetss/js/vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assetss/js/vendors/datatables/jquery.dataTables-bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('assetss/js/vendors/datatables/dataTables.colVis.js')}}"></script>
<script type="text/javascript" src="{{asset('assetss/js/vendors/datatables/colvis.extras.js')}}"></script>

<!--PowerWidgets--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/powerwidgets/powerwidgets.min.js')}}"></script>

<!--FlotChart--> 
<script type="text/javascript" src="{{asset('assetss/js/vendors/flotchart/jquery.flot.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assetss/js/vendors/flotchart/jquery.flot.stack.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assetss/js/vendors/flotchart/jquery.flot.categories.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assetss/js/vendors/flotchart/jquery.flot.time.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assetss/js/vendors/flotchart/jquery.flot.resize.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assetss/js/vendors/flotchart/jquery.flot.axislabels.js')}}"></script> 
<script type="text/javascript" src="{{asset('assetss/js/vendors/flotchart/jquery.flot-tooltip.js')}}"></script> 
<script type="text/javascript" src="{{asset('assetss/js/vendors/flotchart/jquery.flot.pie.min.js')}}"></script>

<!--Bootstrap--> 
<script type="text/javascript" src="{{asset('assetss/js/vendors/bootstrap/bootstrap.min.js')}}"></script>

<!-- x-editable -->
<script type="text/javascript" src="{{asset('assetss/js/vendors/x-editable/bootstrap-editable.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assetss/js/vendors/x-editable/demo.js')}}"></script>
<script type="text/javascript" src="{{asset('assetss/js/vendors/x-editable/demo-mock.js')}}"></script>
<script type="text/javascript" src="{{asset('assetss/js/vendors/x-editable/select2.js')}}"></script>
<script type="text/javascript" src="{{asset('assetss/js/vendors/x-editable/address.js')}}"></script>
<script type="text/javascript" src="{{asset('assetss/js/vendors/x-editable/jquery.mockjax.js')}}"></script>
<script type="text/javascript" src="{{asset('assetss/js/vendors/x-editable/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assetss/css/vendors/x-editable/select2-bootstrap.css')}}"></script>
<script type="text/javascript" src="{{asset('assetss/js/vendors/x-editable/typeahead.js')}}"></script>
<script type="text/javascript" src="{{asset('assetss/js/vendors/x-editable/typeaheadjs.js')}}"></script>

<!--Chat--> 
<script type="text/javascript" src="{{asset('assetss/js/vendors/todos/todos.js')}}"></script>

<!--Main App--> 

<script type="text/javascript" src="{{asset('assetss/js/main.js')}}"></script>
<!--/Scripts-->	

@stop
