@extends ('dashboard.layouts.default')

@section ('titlePage')
  Permisos
@stop
@section ('css')
  <style>
      .box {
        float: left;
        top: -15px;
      }
  </style>
@stop

@section ('contenido')
        <div style="display:none;" class="progress progress-striped active" id="barra">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"        style="width: 100%;"> Procesando...
          </div>
        </div>

      <div id="caragarPanel">
        <!-- Widget Row Start grid -->
        <div class="panel panel-success">
          <div class="panel-heading">
            <h4 id="tituloRol">{{$roles[0]['name']}}</h4> 
            <span class="flotarl"><h4>Selecciona un rol:
            <select name="" id="roles">
                 @foreach($roles as $rol)
                    <option value="{{$rol['id']}}">{{$rol['name']}}</option>
                 @endforeach
              </select> 
              </h4>
              </span>
          </div>
            <div class="panel-body">
                
              <table class="table table-bordered" data-cambio="{{URL::route('cambiarPermisos')}}" data-url="{{URL::route('tablaPermisos')}}" data-rol="{{$roles[0]->id}}" data-token="{{csrf_token()}}">
                  <tr>
                    <th>Menu</th>
                    <th>Modulo</th>
                    <th>Permiso</th>
                  </tr>
                  <tr>
                    <td rowspan="2">Obras</td>
                    <td>
                      Obra
                    </td>
                    <td>
                      <form  class="orb-form">
                      <label class="toggle box">
                            @if($permisos[0]->estado == 1)
                              <input type="checkbox" id="uno" class="cambioPermiso" data-id="{{$permisos[0]->id}}" checked >
                            @else
                              <input type="checkbox" id="uno" class="cambioPermiso" data-id="{{$permisos[0]->id}}" >
                            @endif  
                            <i></i>
                          </label>
                      </form>   
                    </td>
                  </tr>
                   <tr>
                     <td>
                       Nueva obra
                     </td>
                     <td>
                      <form  class="orb-form">
                      <label class="toggle box">
                            @if($permisos[1]->estado == 1)
                              <input type="checkbox" id="dos" class="cambioPermiso" checked  data-id="{{$permisos[1]->id}}">
                            @else
                              <input type="checkbox" id="dos" class="cambioPermiso" data-id="{{$permisos[1]->id}}">
                            @endif
                            <i></i>
                          </label>
                      </form>
                     </td>
                   </tr>
                    <tr>
                    <td rowspan="2">Estimaciones</td>
                    <td>
                      Estimaciones
                    </td>
                    <td>
                      <form  class="orb-form">
                      <label class="toggle box">
                            @if($permisos[2]->estado == 1)
                              <input type="checkbox" id="tres" class="cambioPermiso" checked  data-id="{{$permisos[2]->id}}">
                            @else
                              <input type="checkbox" id="tres" class="cambioPermiso" data-id="{{$permisos[2]->id}}">
                            @endif
                            <i></i>
                          </label>
                      </form>  
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Nueva estimacion
                    </td>
                    <td>
                      <form  class="orb-form">
                      <label class="toggle box">
                            @if($permisos[3]->estado == 1)
                              <input type="checkbox" id="cuatro" class="cambioPermiso" checked  data-id="{{$permisos[3]->id}}">
                            @else
                              <input type="checkbox" id="cuatro" class="cambioPermiso" data-id="{{$permisos[3]->id}}">
                            @endif
                            <i></i>
                          </label>
                      </form>
                    </td>
                  </tr>
                   <tr>
                    <td rowspan="2">Contratistas</td>
                    <td>
                      Contratistas
                    </td>
                    <td>
                      <form  class="orb-form">
                      <label class="toggle box">
                            @if($permisos[4]->estado == 1)
                              <input type="checkbox" id="cinco"  class="cambioPermiso" checked  data-id="{{$permisos[4]->id}}">
                            @else
                              <input type="checkbox" id="cinco" class="cambioPermiso" data-id="{{$permisos[4]->id}}">
                            @endif
                            <i></i>
                          </label>
                      </form>  
                    </td>
                  </tr>
                  <tr>
                    <td>Nuevo Contratistas</td>
                    <td>
                      <form  class="orb-form">
                      <label class="toggle box">
                            @if($permisos[5]->estado == 1)
                              <input type="checkbox" id="seis" class="cambioPermiso" checked data-id="{{$permisos[5]->id}}" >
                            @else
                              <input type="checkbox"  id="seis" class="cambioPermiso" data-id="{{$permisos[5]->id}}">
                            @endif
                            <i></i>
                          </label>
                      </form>  
                    </td>
                  </tr>
                   <tr>
                    <td rowspan="3">Usuarios</td>
                    <td>
                      Alta
                    </td>
                    <td>
                      <form  class="orb-form">
                      <label class="toggle box">
                            @if($permisos[6]->estado == 1)
                              <input type="checkbox" id="siete" class="cambioPermiso" checked data-id="{{$permisos[6]->id}}">
                            @else
                              <input type="checkbox" id="siete" class="cambioPermiso" data-id="{{$permisos[6]->id}}">
                            @endif
                            <i></i>
                          </label>
                      </form>  
                    </td>
                  </tr>
                  <tr>
                     <td>
                      Lista
                    </td>
                    <td>
                      <form  class="orb-form">
                      <label class="toggle box">
                            @if($permisos[7]->estado == 1)
                              <input type="checkbox" id="ocho" class="cambioPermiso" checked data-id="{{$permisos[7]->id}}">
                            @else
                              <input type="checkbox" id="ocho" class="cambioPermiso" data-id="{{$permisos[7]->id}}">
                            @endif
                            <i></i>
                          </label>
                      </form>  
                    </td>
                  </tr>
                  <tr>
                     <td>
                      Permisos
                    </td>
                    <td>
                      <form  class="orb-form">
                      <label class="toggle box">
                            @if($permisos[8]->estado == 1)
                              <input type="checkbox" id="nueve" class="cambioPermiso" checked  data-id="{{$permisos[8]->id}}">
                            @else
                              <input type="checkbox" id="nueve" class="cambioPermiso" data-id="{{$permisos[8]->id}}">
                            @endif
                            <i></i>
                          </label>
                      </form>  
                    </td>
                  </tr>
                </table>
                
                 
                 <div style="display:none;" class="alert alert-warning alert-dismissible" role="alert"></div>
                <div class="page-header"></div>
               
                
                  <button style="float:right;" id="botonCambiarPermisos" class="btn btn-success">Guardar cambios</button>
    




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
<script type="text/javascript" src="{{asset('assetss/js/vendors/powerwidgets/powerwidgets.min.js')}}"></script>

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


<!--Chat--> 
<script type="text/javascript" src="{{asset('assetss/js/vendors/todos/todos.js')}}"></script>

<!--Graficas-->


<script type="text/javascript" src="{{asset('assetss/js/mainn.js')}}"></script>
<!--/Scripts--> 

@stop
