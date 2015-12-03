<!DOCTYPE html>
<!-- Template Name: Clip-Two - Responsive Admin Template build with Twitter Bootstrap 3.x | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
  <!--<![endif]-->
  <!-- start: HEAD -->
  <!-- start: HEAD -->
  <head>
    <title>Login</title>
    <!-- start: META -->
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- end: META -->
    <!-- start: GOOGLE FONTS -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <!-- end: GOOGLE FONTS -->
    <!-- start: MAIN CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/themify-icons/themify-icons.min.css')}}">
    <link href="{{asset('assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.min.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('assets/vendor/switchery/switchery.min.css')}}" rel="stylesheet" media="screen">
    <!-- end: MAIN CSS -->
    <!-- start: CLIP-TWO CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/themes/theme-1.css')}}" id="skin_color" />
    <!-- end: CLIP-TWO CSS -->
    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
  </head>
  <!-- end: HEAD -->
  <!-- start: BODY -->
  <body class="login">
    <!-- start: LOGIN -->
     
    <div class="row">

      <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        @if ( Session::get('error') )
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        @if ( Session::get('notice') )
            <div class="alert">{{ Session::get('notice') }}</div>
        @endif 
        <!--<div class="logo margin-top-30">
          <img src="assets/images/logo.png" alt="Clip-Two"/>
        </div>-->
        <!-- start: LOGIN BOX -->
        <div class="box-login">
          <form class="form-login" method="post" action="{{{ URL::to('/user/login') }}}">
            <input type="hidden" value="{{csrf_token()}}" name="_token">
            <fieldset>
              <legend>
               Inicio de sesión 
              </legend>
              <p>
                Por favor, introduzca su email y contraseña para iniciar sesión.
              </p>
              <div class="form-group">
                <span class="input-icon">
                  <input type="email" class="form-control" name="email" placeholder="Email">
                  <i class="fa fa-user"></i> </span>
              </div>
              <div class="form-group form-actions">
                <span class="input-icon">
                  <input type="password" class="form-control password" name="password" placeholder="Password">
                  <i class="fa fa-lock"></i>
                  <a class="forgot" href="#">
                    Olvidé mi contraseña
                  </a> </span>
              </div>
              <div class="form-actions">
              <!--  <div class="checkbox clip-check check-primary">
                  <input type="checkbox" id="remember" value="1">
                  <label for="remember">
                    Keep me signed in
                  </label>
                </div>-->
                <button type="submit" class="btn btn-primary pull-right">
                  Login <i class="fa fa-arrow-circle-right"></i>
                </button>
              </div>
              <div class="new-account">
                ¿Todavía no tienes una cuenta?
                <a href="{{{ URL::to('/user/create') }}}">
                  Crea una cuenta
                </a>
              </div>
            </fieldset>
          </form>
          <!-- start: COPYRIGHT -->
          <div class="copyright">
            &copy; <span class="current-year"></span><span class="text-bold text-uppercase"> Weintraub</span>. <span>All rights reserved</span>
          </div>
          <!-- end: COPYRIGHT -->
        </div>
        <!-- end: LOGIN BOX -->
      </div>
    </div>
    <!-- end: LOGIN -->
    <!-- start: MAIN JAVASCRIPTS -->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/vendor/modernizr/modernizr.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-cookie/jquery.cookie.js')}}"></script>
    <script src="{{asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/vendor/switchery/switchery.min.js')}}"></script>
    <!-- end: MAIN JAVASCRIPTS -->
    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script src="{{asset('assets/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <!-- start: CLIP-TWO JAVASCRIPTS -->
    <script src="{{asset('assets/js/main.js')}}"></script>
    <!-- start: JavaScript Event Handlers for this page -->
    <script src="{{asset('assets/js/login.js')}}"></script>
    <script>
      jQuery(document).ready(function() {
        Main.init();
        Login.init();
      });
    </script>
    <!-- end: JavaScript Event Handlers for this page -->
    <!-- end: CLIP-TWO JAVASCRIPTS -->
  </body>
  <!-- end: BODY -->
</html>