@extends ('dashboard.layouts.default')

@section ('title')
 Ver - Pedido
@stop
@section ('cssPage')
  {{HTML::style('assetss/css/vendors/x-editable/address.css')}}
  {{HTML::style('assetss/css/vendors/x-editable/select2.css')}}
  {{HTML::style('assetss/css/vendors/x-editable/typeahead.js-bootstrap.css')}}
  {{HTML::style('assetss/css/vendors/x-editable/demo-bs3.css')}}
  {{HTML::style('assetss/css/vendors/x-editable/select2-bootstrap.css')}}
  {{HTML::style('assetss/css/vendors/x-editable/bootstrap-editable.css')}}
@stop

@section('pagina')
  <h2>Datos Del Pedido</h2>
@stop

@section ('contenido')
       
       <!---alert mensajes --->
            @if(Session::has('msg'))
            <div class="alert alert-{{ Session::get('class') }}">
              <button type="button" class="close" data-dismiss="alert">
                <i class="icon-remove"></i>
              </button>
              {{ Session::get('msg')}}
              <br/>
            </div>
            @endif
            <!---/.alert mensajes -->

<div class="row">
    <div class="col-md-6">  
      <fieldset>
          <legend>
            Por
          </legend>
 
              <div class="form-group">
                <div class="col-md-12">
                 <h3>{{$pedidos->responsable}}</h3>
                </div>       
              </div>
      </fieldset>
    </div>
    

            <table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
          <thead>
            <tr>
              <th>Platillo</th>
              <th>Cantidad</th>    
            </tr>
          </thead>
          <tbody>
            @foreach($pedidosplat as $sub)
            <tr>
              @foreach(Platillos::where('id','=',$sub->id_platillo)->select('nombre as nombre')->get() as $muestra)
            <td >{{$muestra->nombre}}</td>
            @endforeach
            <td >{{$sub->cantidad}}</td>
            </tr> 
            @endforeach         
          </tbody>
        </table>
      <br>         
  
  <div class="form-group">  
    <div class="col-md-12">
      <a href="{{URL::route('see.pedidos')}}" class="btn btn-wide btn-success pull-right"> Regresar </a>
    </div>
  </div>




                                
@stop
@section('js')
@stop
