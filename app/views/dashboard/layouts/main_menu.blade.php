<!--Main Menu-->
<div class="sidebar app-aside" id="sidebar">
  <div class="sidebar-container perfect-scrollbar">
    <nav>
    	<div class="navbar-title">
            <span>Menu</span>
        </div>
		  <ul class="main-navigation-menu">
			<li class="{{Route::currentRouteName() == ('home') ? 'active' : '' }}">
				<a href="{{URL::route('home')}}">
					<div class="item-content">
						<div class="item-media">
							<i class="ti-home"></i>
						</div>
						<div class="item-inner">
							<span class="title"> Inicio </span>
						</div>
					</div>
				</a>
			</li>
			<!--Sucursales-->
			 <li class="{{Route::currentRouteName() == ('see.sucursales') ? 'active' : '' }}">
				<a href="{{URL::route('see.sucursales')}}">
					<div class="item-content">
						<div class="item-media">
							<i class="ti-direction-alt"></i>
						</div>
						<div class="item-inner">
							<span class="title"> Sucursales </span>
						</div>
					</div>
				</a>
			</li>
			<!--Unidades-->
			 <li class="{{Route::currentRouteName() == ('see.unidades') ? 'active' : '' }}">
				<a href="{{URL::route('see.unidades')}}">
					<div class="item-content">
						<div class="item-media">
							<i class="ti-paint-bucket"></i>
						</div>
						<div class="item-inner">
							<span class="title"> Unidades </span>
						</div>
					</div>
				</a>
			</li>
			<!--materia prima-->
			<li class="{{Route::currentRouteName() == ('see.materias') ? 'active' : '' }}">
				<a href="{{URL::route('see.materias')}}">
					<div class="item-content">
						<div class="item-media">
							<i class="ti-export"></i>
						</div>
						<div class="item-inner">
							<span class="title"> Materia Prima </span>
						</div>
					</div>
				</a>
			</li>
			<!--proveedores-->
			<li class="{{Route::currentRouteName() == ('see.proveedores') ? 'active' : '' }}">
				<a href="{{URL::route('see.proveedores')}}">
					<div class="item-content">
						<div class="item-media">
							<i class="ti-thumb-up"></i>
						</div>
						<div class="item-inner">
							<span class="title"> Proveedores </span>
						</div>
					</div>
				</a>
			</li>
			<!--empaques-->
			 <li class="{{Route::currentRouteName() == ('see.empaques') ? 'active' : '' }}">
				<a href="{{URL::route('see.empaques')}}">
					<div class="item-content">
						<div class="item-media">
							<i class="ti-package"></i>
						</div>
						<div class="item-inner">
							<span class="title"> Empaques </span>
						</div>
					</div>
				</a>
			</li>
			<!--platillos-->
			<li class="{{Route::currentRouteName() == ('see.platillos') ? 'active' : '' }}">
				<a href="{{URL::route('see.platillos')}}">
					<div class="item-content">
						<div class="item-media">
							<i class="ti-control-record"></i>
						</div>
						<div class="item-inner">
							<span class="title"> Platillos </span>
						</div>
					</div>
				</a>
			</li>
			<!--pedidos-->
			 <li class="{{Route::currentRouteName() == ('see.pedidos') ? 'active' : '' }}">
				<a href="{{URL::route('see.pedidos')}}">
					<div class="item-content">
						<div class="item-media">
							<i class="ti-truck"></i>
						</div>
						<div class="item-inner">
							<span class="title"> Pedidos </span>
						</div>
					</div>
				</a>
			</li>
			<!--orden de compra-->
			<li class="{{Route::currentRouteName() == ('see.orden') ? 'active' : '' }}">
				<a href="{{URL::route('see.orden')}}">
					<div class="item-content">
						<div class="item-media">
							<i class="ti-money"></i>
						</div>
						<div class="item-inner">
							<span class="title"> Orden de Compra </span>
						</div>
					</div>
				</a>
			</li>
		  </ul>   
	</nav>
  </div>
</div>
<!--/MainMenu-->