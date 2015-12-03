<html>
  
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ORB | Login</title>
    {{ HTML::style('assets/css/styles.css'); }}
  </head>
  
  <body>
    <div class="colorful-page-wrapper">
      
      <div class="center-block">
        <div class="login-block">
          <form action="{{url()}}/user/login" method="post" id="login-form" class="orb-form">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <header>
              Login
              <small>¿No tienes cuenta registrate? —
                <a href="{{url()}}/user/create">Registrate</a>
              </small>
            </header>
            <fieldset>
              <section>
                <div class="row">
                  <label class="label col col-4">E-mail</label>
                  <div class="col col-8">
                    <label class="input">
                      <i class="icon-append fa fa-user"></i>
                      <input type="email" name="email">
                    </label>
                  </div>
                </div>
              </section>
              <section>
                <div class="row">
                  <label class="label col col-4">Contraseña</label>
                  <div class="col col-8">
                    <label class="input">
                      <i class="icon-append fa fa-lock"></i>
                      <input type="password" name="password">
                    </label>
                    <div class="note">
                      <a href="#">¿Olvodo su contraseña?</a>
                    </div>
                  </div>
                </div>
              </section>
              <section>
                <div class="row">
                  <div class="col col-4"></div>
                  <div class="col col-8">
                      
                  </div>
                </div>
              </section>
            </fieldset>
            <footer>
              <button type="submit" class="btn btn-default">Log in</button>
            </footer>
          </form>
        </div>
        <div class="copyrights"> © 2015 Weintraub</div>
      </div>
    </div>
    <!--Scripts-->
    <!--JQuery-->
    <script type="text/javascript" src="js/vendors/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="js/vendors/jquery/jquery-ui.min.js"></script>
    <!--Forms-->
    <script type="text/javascript" src="js/vendors/forms/jquery.form.min.js"></script>
    <script type="text/javascript" src="js/vendors/forms/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/vendors/forms/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="js/vendors/jquery-steps/jquery.steps.min.js"></script>
    <!--NanoScroller-->
    <script type="text/javascript" src="js/vendors/nanoscroller/jquery.nanoscroller.min.js"></script>
    <!--Sparkline-->
    <script type="text/javascript" src="js/vendors/sparkline/jquery.sparkline.min.js"></script>
    <!--Main App-->
    <script type="text/javascript" src="js/scripts.js"></script>
    <!--/Scripts-->
  </body>

</html>