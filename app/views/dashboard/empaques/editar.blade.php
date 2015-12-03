@extends ('dashboard.layouts.default')

@section ('title')
  Editar Empaque
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
  <h2>Editar Empaque</h2>
@stop

@section ('contenido')
       
               
            <!--PAGE CONTENT BEGINS-->

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
            
            <div class="alert alert-error" id="alert" style="display:none">
              <button type="button" class="close" data-dismiss="alert">
                <i class="icon-remove"></i>
              </button>
                Los cambios no fueron realizados, intente de nuevo
              <br/>
            </div>
            <!---/.alert mensajes -->
 <fieldset>
 <div class="row">
    <div class="col-md-5">  
      <fieldset>
          <legend>
           Empaque
          </legend>
              <div class="form-group">
                <div class="col-md-8">
                
                  <h4>{{$empaquesmp->nombre}}</h4>
             
                </div>       
              </div>
      </fieldset>
    </div>

 <fieldset>
        <legend>
           Editar Empaque
          </legend>
        <div class="form-group">  
                <div class="col-md-12" align="left">
                  <form method="post" action="{{ URL::to('dashboard/empaques/'.$empaquesmp->id.'/editar/') }}" class="form-horizontal">
                  <input name="_token" type="hidden" value="{{csrf_token()}}">
                  <style type="text/css">#materia{ height: 30px; width: 160px} </style>
                  <input type="hidden" name="id_pedido"  value="" >
                  <div class="form-group">
                  <div class="col-md-12">
                    Nombre
                    <input type="text" id="nombre" style="margin-top:2%"  name="nombre"  value="{{$empaquesmp->nombre}}">
                  </div>
                  </div>
                  <div class="form-group">
                  <div class="col-md-12">
                    Cantidad
                  <input type="number" min="1"  id="cantidad" style="margin-top:2%"  name="cantidad"  value="{{$empaquesmp->cantidad}}">
                  @if ($empaques->Materias->Unidades->id > 0)
                  {{$empaques->Materias->Unidades->nombre}} ({{$empaques->Materias->Unidades->abreviatura}})
                  @endif
                  
                  </div>
                  </div>

                   <div class="form-group">
                  <div class="col-md-12">
                    Precio
                  <input type="number" min="1" step="any"  id="precio" required placeholder="Precio"  name="precio" style="margin-top:2%" value="{{$empaquesmp->precio}}">
                  $
                  </div>
                  </div>

                   <div class="form-group">
                  <div class="col-md-12">
                    Proveedor
                  <select id="proveedor" required name="proveedor" style="margin-top:2%">
                  <option hidden=""  value=""> Proveedor </option>
                  
                  @foreach($proveedores as $proveedor)
                  <option value="{{$proveedor->id}}" @if($proveedor->id==$empaquesmp->proveedor) selected @endif>{{$proveedor->nombre}}</option>
                  @endforeach
                  </select>
                  </div>
                  </div>


                  <button title="Guardar" class="btn btn-primary">Actualizar</button>
                 <br><br> <br> 
               </form>
                        <table  class="table table-hover">
                          <thead>
                            <tr>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Proveedor</th>
                            <th>Editar</th>
                         </tr></thead>

               <tbody>   
                @foreach($listaempaquesmp as $emp)
                <tr>
                <td>{{$emp->nombre}}</td>
                <td>{{$emp->cantidad}}</td>
                <td >@if($emp->precio !=null) {{number_format ( $emp->precio, 2, "," , "." )}}$ @endif</td>
                <td>@if($emp->proveedor !=null) {{$emp->Proveedores->nombre}} @endif</td>
                <td width=" 2%" align="center"><a  href="{{ URL::to('dashboard/empaques/editar/'.$emp->id) }}"  class="btn bnt-wide btn-yellow"><i class="fa fa-pencil"></i></a></td>
                </tr>
                @endforeach
                 </tbody> 
                 </table>
                 <br> 
                
                 <br> 
                  
                </div>
                    </div>
         </fieldset>               

    <div class="col-md-18">

  <div class="form-group" align="center" >  
  <div class="col-md-12">
   
      <a  href="{{ URL::to('dashboard/empaques/edit/'.$empaquesmp->empaques_id) }}"   class="btn btn-wide btn-success pull-right">Regresar</a>
    
  </div>
</div>
</div>
  </div>



@stop

@section('js')

    
@stop