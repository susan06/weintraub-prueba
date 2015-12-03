<!DOCTYPE html>
<html> 
  <head>
    <title>
      @yield('title')
    </title>
    <!-- start: META -->
    <!--[if IE]>
      <meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1"
      />
    <![endif]-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="" name="description">
    <meta content="" name="author">
    <!-- end: META -->
    <!-- start: GOOGLE FONTS -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css">
    <!-- end: GOOGLE FONTS -->
    <!-- start: MAIN CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendor/DataTables/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/themify-icons/themify-icons.min.css')}}">
    <link href="{{asset('assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet"
    media="screen">
    <link href="{{asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.min.css')}}"
    rel="stylesheet" media="screen">
    <!-- end: MAIN CSS -->
    <!-- start: CLIP-TWO CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/themes/theme-1.css')}}" id="skin_color">
    <!-- end: CLIP-TWO CSS -->
    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->

    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
    <link  href="{{asset('assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" media="screen">
    <link  href="{{asset('assets/vendor/select2/select2.min.css')}}" rel="stylesheet" media="screen">
    <link  href="{{asset('assets/vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css')}}" rel="stylesheet" media="screen">
    <link  href="{{asset('assets/vendor/bootstrap-timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet)}}" media="screen">
   
    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
   <link  href="{{asset('assets/vendor/sweetalert/sweet-alert.css')}}" rel="stylesheet" media="screen">
   <link  href="{{asset('assets/vendor/sweetalert/ie9.css')}}" rel="stylesheet" media="screen">
   <link  href="{{asset('assets/vendor/toastr/toastr.min.css')}}" rel="stylesheet" media="screen">
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->

    @yield('css')

  </head>
  
  <body>
    <div id="app">
      <!-- sidebar -->
       	@include('dashboard.layouts.main_menu')
      <!-- / sidebar -->
      <div class="app-content">
        <!-- start: TOP NAVBAR -->
        <header class="navbar navbar-default navbar-static-top">
          <!-- start: NAVBAR HEADER -->

          <div class="navbar-header">
            <a class="site-brand" href="#" >
            <!-- <img  src="{{asset('imgp/img_creditodo.png')}}"> -->
            </a>
            <a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
				<i class="ti-align-justify"></i>
			</a>
            <a href="#" class="sidebar-toggler pull-right visible-md visible-lg" data-toggle-class="app-sidebar-closed" data-toggle-target="#app">
				<i class="ti-align-justify"></i>
			</a>
            <a class="pull-right menu-toggler visible-xs-block" id="menu-toggler" data-toggle="collapse" href=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<i class="ti-view-grid"></i>
			</a>
          </div>
          <!-- end: NAVBAR HEADER -->
          <!-- start: NAVBAR COLLAPSE -->
          <div class="navbar-collapse collapse">
            <h2>
              @section('pagina') 
              	Proyecto
              @show
            </h2>
            <ul class="nav navbar-right"></ul>
            <!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
            <div class="close-handle visible-xs-block menu-toggler" data-toggle="collapse" href=".navbar-collapse">
              <div class="arrow-left"></div>
              <div class="arrow-right"></div>
            </div>
            <!-- end: MENU TOGGLER FOR MOBILE DEVICES -->
          </div>
          <a class="dropdown-off-sidebar" data-toggle-class="app-offsidebar-open" data-toggle-target="#app" data-toggle-click-outside="#off-sidebar">&nbsp;</a>
          <!-- end: NAVBAR COLLAPSE -->
        </header>
        <!-- end: TOP NAVBAR -->
        <div class="main-content">
          <div class="wrap-content container" id="container">
          	 <div class="container-fluid container-fullw bg-white">
              <div class="row">
                <div class="col-md-11">
          			 @yield('contenido')
          		</div>
          	  </div>
          	</div>
          </div>          
        </div>
      </div>
      <!-- start: FOOTER -->
      <footer>
        <div class="footer-inner">
          <div class="pull-left">©
            <span class="current-year"></span>
            <span class="text-bold text-uppercase">Weintraub</span>.
            <span>All rights reserved</span>
          </div>
          <div class="pull-right">
            <span class="go-top">
              <i class="ti-angle-up"></i>
            </span>
          </div>
        </div>
      </footer>
      <!-- end: FOOTER -->
      <!-- start: OFF-SIDEBAR -->
         <!--##################
         	 ##################
         	 ##################-->
         			@include('dashboard.layouts.offcanvas_menu');
    	<!--	###################
    		###################
    		###################
    	-->
    <!-- end: OFF-SIDEBAR -->
    <!-- start: SETTINGS -->
    		@include("dashboard.layouts.configuracion")
    <!-- end: SETTINGS -->
    </div>
    <!-- start: MAIN JAVASCRIPTS -->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/vendor/modernizr/modernizr.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-cookie/jquery.cookie.js')}}"></script>
    <script src="{{asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/vendor/switchery/switchery.min.js')}}"></script>
    <!-- end: MAIN JAVASCRIPTS -->
    <script src="{{asset('assets/vendor/maskedinput/jquery.maskedinput.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
    <script src="{{asset('assets/vendor/autosize/autosize.min.js')}}"></script>
    <script src="{{asset('assets/vendor/selectFx/classie.js')}}"></script>
    <script src="{{asset('assets/vendor/selectFx/selectFx.js')}}"></script>
    <script src="{{asset('assets/vendor/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-timepicker/bootstrap-timepicker.min.js')}}"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY Notifications -->
    <script  src="{{asset('assets/vendor/sweetalert/sweet-alert.min.js')}}"></script>
    <script  src="{{asset('assets/vendor/toastr/toastr.min.js')}}"></script>
    <script  src="{{asset('assets/js/ui-notifications.js')}}"></script>

<!-- start: CLIP-TWO JAVASCRIPTS -->
    <script  src="{{asset('assets/js/form-elements.js')}}"></script>
    <script src="{{asset('assets/vendor/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/vendor/DataTables/jquery.dataTables.min.js')}}"></script>
    <!-- start: CLIP-TWO JAVASCRIPTS -->
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/table-data.js')}}"></script>
	
    <!-- start: JavaScript Event Handlers for this page -->
    <script>
      jQuery(document).ready(function() {
		Main.init();
		TableData.init();
		UINotifications.init();
		FormElements.init();
     });
    </script>
	
	@yield('js')
    <!-- end: JavaScript Event Handlers for this page -->
    <!-- end: CLIP-TWO JAVASCRIPTS -->
  </body>

</html>