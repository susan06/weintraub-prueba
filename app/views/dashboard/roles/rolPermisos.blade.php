@extends ('dashboard.layouts.default')

@section ('titlePage')
  HABITARIA - PANEL | Árbol de Permisos
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
        <li class="active">Permisos</li>
        </ul>
      </div>
    <!--/Breadcrumb-->
    
    <div class="page-header">
       <h1>Roles <small> asignacion de permisos</small></h1>      
    </div>
        <div id="caragarPanel">
        <!-- Widget Row Start grid -->
        <div class="panel panel-success">
          <div class="panel-heading">
            <h4 id="tituloRol">SuperAdmin</h4> 
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
                
              <div class="inner-spacer">
                <div class="tree well margin-0px">
                  <table class="table table-bordered" data-rol="">
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
                            <input type="checkbox" checked >
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
                            <input type="checkbox" checked >
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
                            <input type="checkbox" checked >
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
                            <input type="checkbox" checked >
                            <i></i>
                          </label>
                      </form>
                    </td>
                  </tr>
                </table>
                 <div style="display:none;" class="alert alert-warning alert-dismissible" role="alert"></div>
                <div class="page-header"></div>
               
                <footer>
                  <button style="float:right;" id="botonCambiarPermisos" class="btn btn-success">Guardar cambios</button>
                </footer><br><br>
                </div>

              </div>
              
            </div>
            
            
            <!-- /New widget --> 
            <div id="caragarPanel">
    <!-- New widget -->
            
            <!-- /New widget --> 
      <!-- New widget -->
           
            <!-- /New widget --> 

      <!-- New widget -->
            
            
            <!-- /New widget --> 

      <!-- New widget -->
            
            <!-- /New widget --> 
      
          </div>
          
          <!-- /Inner Row Col-md-12 --> 
          
        </div>
        <!-- /Widgets Row End Grid-->
    
      </div>
      <!-- / Content Wrapper --> 
    </div>
    <!--/MainWrapper--> 
  </div>
<!--/Smooth Scroll--> 


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

<!--PowerWidgets--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/powerwidgets/powerwidgets.min.js')}}"></script>

<!--Bootstrap--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/bootstrap/bootstrap.min.js')}}"></script>

<!--Chat--> 
<script type="text/javascript" src="{{asset('assets/js/vendors/todos/todos.js')}}"></script>

<!--Main App--> 
<script type="text/javascript" src="{{asset('assets/js/scripts_es.js')}}"></script>
<!--<script type="text/javascript" src="{{asset('assets/index/js/main.js')}}"></script>-->
<script type="text/javascript" src="{{asset('assets/js/main.js')}}"></script>

<!--/Scripts--> 

@stop
