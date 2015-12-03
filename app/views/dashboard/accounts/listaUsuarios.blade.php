@extends ('dashboard.layouts.default')

@section ('titlePage')
	Lista de usuarios
@stop
@section ('cssPage')
	
@stop

@section('pagina')
  <h2>Listado de usuarios</h2>
@stop

@section ('contenido')	
           <table id="tabla" class="table-dark table table-striped table-bordered table-hover margin-0px">
                  <thead>
                    <tr>
                      <th># </th>
                      <th width="15%" >Usuario</th>
                      <th width="">Email</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach($usuarios as $object)
                     
                    
                    <tr>
                      <td width="1%"><span class="num">{{$i++}}</span></td>
                      <td>{{$object->username}}</td>
                      <td>{{$object->email}}</td>
                    </tr>
                     @endforeach
                    </tbody>
                </table>
                {{$usuarios->links()}}
<!-- scroll top -->
<div class="scroll-top-wrapper hidden-xs">
    <i class="fa fa-angle-up"></i>
</div>
<!-- /scroll top -->


<!--Scripts--> 
<!--JQuery--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/jquery/jquery-ui.min.js')}}"></script>

<!--Fullscreen--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/fullscreen/screenfull.min.js')}}"></script>

<!--NanoScroller--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/nanoscroller/jquery.nanoscroller.min.js')}}"></script>

<!--Sparkline--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/sparkline/jquery.sparkline.min.js')}}"></script>

<!--Horizontal Dropdown--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/horisontal/cbpHorizontalSlideOutMenu.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/classie/classie.js')}}"></script>

<!--Datatables--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/datatables/jquery.dataTables-bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/datatables/dataTables.colVis.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/vendors/datatables/colvis.extras.js')}}"></script>

<!--PowerWidgets--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/powerwidgets/powerwidgets.min.js')}}"></script>

<!--FlotChart--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.stack.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.categories.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.time.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.resize.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.axislabels.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot-tooltip.js')}}"></script> 
<script type="text/javascript" src="{{asset('assets/js/vendors/flotchart/jquery.flot.pie.min.js')}}"></script>

<!--Bootstrap--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/bootstrap/bootstrap.min.js')}}"></script>

<!--Chat--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/todos/todos.js')}}"></script>

<!--Graficas-->

<script type="text/javascript" src="{{asset('assets/js/scripts.js')}}"></script>

<!--/Scripts-->	

@stop
