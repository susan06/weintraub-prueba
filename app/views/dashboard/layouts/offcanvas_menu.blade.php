<!--OffCanvas Menu -->
<!-- Tabs -->
<div id="off-sidebar" class="sidebar">
	<div class="sidebar-wrapper">
  <ul class="nav nav-tabs nav-justified">
	<li class="active"><a href="#userbar-one" data-toggle="tab"></a></li>
  </ul>
  <div class="tab-content"> 	
	<!--User Primary Panel-->
	<div class="tab-pane active" id="userbar-one">
	  <div class="main-info">
		@if(Auth::user()->img == "" || Auth::user()->img == null)
		<div class="user-img">
			<i style="font-size:4em;" class="glyphicon glyphicon-user"></i>
			<!--<img src="{{asset('uploads/users/default.png')}}" alt="User Picture" />-->
			<form action="{{URL::route('subirImagen')}}" method="post" class="orb-form" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				   <label for="img" class="btn btn-info">Buscar Imagen</label>
				   <small>{{$errors->first('img')}}</small>
				   <input id="img"  name="img" type="file" style="display:none;">
              		<br>
              		<br>
					<input class="btn btn-success" type="submit" value="Cargar">
			</form>
		</div>
		@else
		   <div style="text-align:center;"><img with="100" height="100" src="{{url()}}/imgp/{{Auth::user()->img}}" alt="User Picture"></div>
		@endif
		<div class="list-group-item goaway">Usuario: {{Auth::user()->username}}</div>
		<div class="list-group-item goaway">E-mail: {{Auth::user()->email}}</div>
	  </div>
		<div class="empthy"></div>
		<!--<a href="#" class="list-group-item goaway"><i class="entypo-user"></i>Perfil</a>-->
		<a href="{{url()}}/user/logout" class="list-group-item goaway"><i class="fa fa-power-off"></i>Salir</a> </div>
	</div>
	</div>
</div>
	<!--User Chat Panel-->

	<!--User Tasks Panel-->
	
<!-- /tabs --> 

<!-- /Offcanvas user menu--> 
