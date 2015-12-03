@extends ('dashboard.layouts.default')

@section ('title')
 Ver - Orden
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
  <h2>Listado por Sucursales</h2>
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

 
    <div class="col-md-12">  
      <fieldset>
          <legend>
          Sucursal
          </legend>
            <form method="post" action="{{ URL::route('post.list.orden') }}" class="form-horizontal">
            <input name="_token" type="hidden" value="{{csrf_token()}}">
              <div class="form-group">
                <div class="col-md-4">
                
                <select class="form-control" required name="id">
                   @if(count($sucursalesb) > 0)
                     <option value="" hidden="">Seleccionar Sucursal</option>
                       @foreach($sucursalesb as $sucursal)
                         <option value="{{$sucursal->id}}" @if($sucursal->id == $id) selected  @endif>{{$sucursal->sucursal}}</option>
                       @endforeach
                   @else
                     <option value="">No hay Sucursales registradas</option>
                   @endif
                </select>
                </div> 
                 <button type="submit" id="" name="" class="btn btn-wide btn-primary pull-left"><i class="fa fa-search"></i>Consultar Sucursal</button>      
              </div>
            
            </form>
      </fieldset>
    </div>
   
        <div id="mostrar" class="row" @if($id==0) style="display:none" @endif>
            <table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
          <thead>
            <tr>
              <th>Responsable</th>
              <th>Nombre</th>
              <th>Fecha</th>
              <th>Ver</th>
              <th>Editar</th>
              <th>Eliminar</th>       
            </tr>
          </thead>
          <tbody>
           @foreach($orden as $ord) 
            <tr>
            <td >{{$ord->Usuario->username}}</td>
            <td >{{$ord->nombre}}</td>
            
            <td >{{$ord->created_at}}</td>
           
            <td width=" 2%" align="center"> 
             <a  href="{{ URL::to('dashboard/orden/show/'.$ord->id.'/'.$val=1) }}"  class="btn bnt-wide btn-blue"><i class="fa fa-search"></i>
              </td>
        <td width="2%" align="center">
             <a  href="#"   class="btn bnt-wide btn-yellow"><i class="fa fa-pencil"></i></a>
              </td>
        <td width="2%" align="center"> 
             <a onclick="return confirmar('accion.html')" href="#" class="btn bnt-wide btn-red"><i class="fa fa-trash-o"></i></a>
              </td>
            </tr> 
          @endforeach        
          </tbody>
        </table>
      <br>         
  
  <div class="form-group">  
    <div class="col-md-12">
      <a href="{{URL::route('see.orden')}}" class="btn btn-wide btn-success pull-right"> Regresar </a>
    </div>
  </div>




                                
@stop
@section('js')

@stop
