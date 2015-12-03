<div id="cargarTabla">
  <table class="table table-bordered table-hover" >
        <tr>
          <th width="30%">Usuario</th>
          <th>Rol</th>
        </tr>
        @foreach($roles as $rol)
        <tr>
             <td>{{$rol['name']}}</td>
             <td>
                <button  class="eliminar label label-danger" id="boton" name="{{$rol['id']}}"><i class="glyphicon glyphicon-remove"></i></button>
             </td>
           </tr>
        @endforeach
      </table>
      </div>