@extends ('dashboard.layouts.default')

@section ('titlePage')
	HABITARIA - PANEL | Asignar rol
@stop
@section ('cssPage')
	{{ HTML::style('assets/css/styles.css'); }}
@stop

@section ('pageContent')
<!--Smooth Scroll-->
	<div class="smooth-overflow">
		@include('dashboard.layouts.navigation')
	
	<!--MainWrapper-->
	<div class="main-wrap"> 
		<!--OffCanvas Menu -->
			@include('dashboard.layouts.offcanvas_menu')
		<!--Main Menu-->
			@include('dashboard.layouts.main_menu')
			
			<div class="content-wrapper"> 
        <!--Content Wrapper-->
			<!--Horisontal Dropdown-->
			@include('dashboard.layouts.horizontal_dropdown')
			
		<!--Breadcrumb-->
			<div class="breadcrumb clearfix">
			  <ul>
				<li><a href="{{URL::route('home')}}"><i class="fa fa-home"></i></a></li>
				<li class="active">Inicio</li>
			  </ul>
			</div>
		 
		 <div class="page-header">
			 <h1>Habitaria<small>Roles</small></h1>
			 
		 </div>
		
		@if(count($users) > 0)
    <div class="panel panel-success">
		<div class="panel-heading">tabla de asignacion de roles</div>
		<div class="panel-body">
			
      <table class="table table-bordered">
        <tr>
          <th>Usuario {{count($users)}}</th>
          <th>Rol</th>
        </tr>
        @foreach($users as $user)
        <tr>
             <td>{{$user['email']}}</td>
             <td>
                <select name="" class="asignarRol">
                  <option value="{{$user['role_id'].'.'.$user['user_id']}}" >{{$user['name']}}</option>
                  @foreach($roles as $rol) 
                    @if($rol['name'] != $user['name'])
                      <option value="{{$rol['id'].'.'.$user['user_id']}}">{{$rol['name']}}</option>
                    @endif
                  @endforeach
                </select>
             </td>
           </tr>
           @endforeach
      </table>
          <div class="page-header"></div>
<div style="display:none;" class="alert alert-default alert-dismissible" role="alert"></div>
<button style="float:right;" id="botonAsignarRol" class="btn btn-success">Guardar cambios</button>
		</div>

	</div>

@else
  <div style="display:block;" class="alert alert-default alert-dismissible" role="alert">
    No hay usuarios registrados 
  </div>
@endif

<!-- scroll top -->
<div class="scroll-top-wrapper hidden-xs">
    <i class="fa fa-angle-up"></i>
</div>
<!-- /scroll top -->



<!--Modals-->

<!--Power Widgets Modal-->
<div class="modal" id="delete-widget">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <i class="fa fa-lock"></i> </div>
      <div class="modal-body text-center">
        <p>Are you sure to delete this widget?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="trigger-deletewidget-reset">Cancel</button>
        <button type="button" class="btn btn-primary" id="trigger-deletewidget">Delete</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 

<!--Sign Out Dialog Modal-->
<div class="modal" id="signout">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <i class="fa fa-lock"></i> </div>
      <div class="modal-body text-center">Are You Sure Want To Sign Out?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="yesigo">Ok</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 

<!--Lock Screen Dialog Modal-->
<div class="modal" id="lockscreen">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <i class="fa fa-lock"></i> </div>
      <div class="modal-body text-center">Are You Sure Want To Lock Screen?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="yesilock">Ok</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 

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

<!--Main App--> 
<script type="text/javascript" src="{{asset('assets/js/scripts.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/index/js/main.js')}}"></script>
<!--/Scripts-->	

@stop
