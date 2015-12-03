@extends ('dashboard.layouts.default')

@section ('title')
  Editar Pedido
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
  <h2>Editar Pedido</h2>
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
            Platillo
          </legend>
              <div class="form-group">
                <div class="col-md-8">
                
                  <h4>{{$pedidosplat->Platillos->nombre}}</h4>
             
                </div>       
              </div>
      </fieldset>
    </div>

 <fieldset>
        <legend>
           Editar Platillo
          </legend>
        <div class="form-group">  
                <div class="col-md-12" align="left">
                  <form method="post" action="{{ URL::to('dashboard/pedidos/'.$pedidosplat->id.'/editar/') }}" class="form-horizontal">
                  <input name="_token" type="hidden" value="{{csrf_token()}}">
                  <style type="text/css">#materia{ height: 30px; width: 160px} </style>
                  <input type="hidden" name="id_pedido"  value="{{$pedidosplat->id_pedido}}" >
                  <select  id="id_platillo" name="id_platillo"  style="margin-top:2%" >
                  @foreach ($platillos as $platillo)
                  <option value="{{$platillo->id}}" @if($platillo->id==$pedidosplat->id_platillo) selected  @endif>{{$platillo->nombre}}</option>
                  @endforeach                  
                  </select>
                  <input type="number" min="1" required placeholder="Cantidad"  id="cantidad" style="margin-top:2%"  name="cantidad"  value="{{$pedidosplat->cantidad}}">
                  <button title="Guardar" class="btn btn-primary">Actualizar</button>
                 <br><br> <br> 
               </form>
                        <table  class="table table-hover">
                          <thead>
                            <tr>
                            <th>Platillos</th>
                            <th>Cantidades</th>
                            <th>Editar</th>
                         </tr></thead>

               <tbody>   
                @foreach ($listaplatillos as $platillos)
                <tr>
                <td>{{$platillos->Platillos->nombre}}</td>
                <td>{{$platillos->cantidad}}</td>
                <td width=" 2%" align="center"><a  href="{{ URL::to('dashboard/pedidos/editar/'.$platillos->id) }}"  class="btn bnt-wide btn-yellow"><i class="fa fa-pencil"></i></a></td>
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
   
      <a  href="{{ URL::to('dashboard/pedidos/edit/'.$pedidosplat->id_pedido) }}"   class="btn btn-wide btn-success pull-right">Regresar</a>
    
  </div>
</div>
</div>
  </div>



@stop

@section('js')

    
@stop