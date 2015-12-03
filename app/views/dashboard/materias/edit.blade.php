@extends ('dashboard.layouts.default')

@section ('title')
  Editar Materia Prima
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
  <h2>Agregar Materia Prima</h2>
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

<form method="post" action="{{ URL::to('dashboard/materias/'.$materias->id.'/edit/') }}" class="form-horizontal">
  <input name="_token" type="hidden" value="{{csrf_token()}}">
   
      <fieldset>
      <legend>
        Datos de la Materia Prima
      </legend>
        <div class="form-group">
          <div class="col-md-4">
            <label class="control-label">Nombre</label>
            <input type="text" required name="nombre" placeholder="Ingresar nombre" class="form-control" value="{{$materias->nombre}}" ><br>
          </div>

          
          <div class="col-sm-4">
              <label class="control-label" for=""> Unidad</label>
                <div class="input-group">
                  
                    <select class="form-control" required name="unidad">
                    <option value="">Seleccione la unidad</option>
                    @foreach ($unidades as $und)
                    <option value="{{$und->id}}" @if($materias->unidad == $und->id) selected @endif > {{$und->nombre}}</option>
                    @endforeach
                    </select>
                  
                </div>
          </div>
        </div>
      </fieldset>      

     
      <div class="form-group">
        <div class="col-sm-11">
          <div class="form-group" align="right">  
            <a href="{{ URL::route('see.materias') }}" class="btn btn-wide btn-success pull-right">Regresar</a>
            <button type="submit" name="" class="btn btn-wide btn-primary pull-right">Guardar</button>  
          </div>
        </div>
      </div>
      
    
</form>

@stop

@section('js')

   
@stop