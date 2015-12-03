@extends ('dashboard.layouts.default')

@section('title')
  Inicio
@stop

@section('pagina')
  <h1>Inicio</h1> 
@stop

@section('contenido')
  <h3>Bienvenido a: Weintraub </h3><br><br>

  	<div align="left">Weintraub ofrece una variedad de productos a todos sus usuarios<br><br>
  	<p>Realice sus compras</p>
	<h4><strong><a href="{{URL::to('excel/21')}}">excel</a></strong></h4>
  	</div>
@stop

