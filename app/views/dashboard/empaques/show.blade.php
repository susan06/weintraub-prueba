@extends ('dashboard.layouts.default')

@section ('title')
 Ver - Empaques
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
  <h2>Datos De Empaque</h2>
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
            Empaque
          </legend>
 
              <div class="form-group">
                <div class="col-md-12">
                  @foreach(Materias::where('id','=',$empaques->materia_prima)->get() as $materia)
                 <h3>{{$materia->nombre}}</h3>
                 @endforeach
                </div>       
              </div>
      </fieldset>
    </div>
    

            <table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Cantidad</th> 
              <th>Precio</th> 
              <th>Proveedor</th>    
            </tr>
          </thead>
          <tbody>
            @foreach($empaques_mp as $empaque)
            <tr>
            <td >{{$empaque->nombre}}</td>
            <td >{{$empaque->cantidad}} {{$empaque->Empaques->Materias->Unidades->abreviatura}}</td>
            <td >@if($empaque->precio !=null) {{number_format ( $empaque->precio, 2, "," , "." )}} $ @endif</td>
            <td >@if($empaque->proveedor !=null) {{$empaque->Proveedores->nombre}} @endif</td>
            </tr> 
            @endforeach         
          </tbody>
        </table>
      <br>         
  
  <div class="form-group">  
    <div class="col-md-12">
      <a href="{{URL::route('see.empaques')}}" class="btn btn-wide btn-success pull-right"> Regresar </a>
    </div>
  </div>




                                
@stop
@section('js')
@stop
