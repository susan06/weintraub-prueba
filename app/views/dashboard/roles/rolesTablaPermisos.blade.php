<div class="panel panel-success">
          <div class="panel-heading">
            <h4 id="tituloRol">{{$role}}</h4> 
            <span class="flotarl"><h4>Selecciona un rol:
            <select name="" id="roles">
                  <option value="{{$id}}">{{$role}}</option>
                  @foreach($roles as $rol)
                    @if($rol['name'] != $role)
                      <option value="{{$rol['id']}}">{{$rol['name']}}</option>
                    @endif
                  @endforeach
              </select> 
              </h4>
              </span>
          </div>
            <div class="panel-body">
                
              
                   <table class="table table-bordered" data-cambio="{{URL::route('cambiarPermisos')}}" data-token="{{csrf_token()}}" data-url="{{URL::route('tablaPermisos')}}" data-rol="{{$roles[0]['id']}}">
                   <tr>
                    <th>Menu</th>
                    <th>Modulo</th>
                    <th>Permiso</th>
                  </tr>
                  <tr>
                    <td rowspan="2">Obras</td>
                    <td>
                      Obra
                    </td>
                    <td>
                      <form  class="orb-form">
                      <label class="toggle box">
                            @if($permisos[0]->estado == 1)
                              <input type="checkbox" id="uno" class="cambioPermiso" data-id="{{$permisos[0]->id}}" checked >
                            @else
                              <input type="checkbox" id="uno" class="cambioPermiso" data-id="{{$permisos[0]->id}}" >
                            @endif  
                            <i></i>
                          </label>
                      </form>   
                    </td>
                  </tr>
                   <tr>
                     <td>
                       Nueva obra
                     </td>
                     <td>
                      <form  class="orb-form">
                      <label class="toggle box">
                            @if($permisos[1]->estado == 1)
                              <input type="checkbox" id="dos" class="cambioPermiso" checked  data-id="{{$permisos[1]->id}}">
                            @else
                              <input type="checkbox" id="dos" class="cambioPermiso" data-id="{{$permisos[1]->id}}">
                            @endif
                            <i></i>
                          </label>
                      </form>
                     </td>
                   </tr>
                    <tr>
                    <td rowspan="2">Estimaciones</td>
                    <td>
                      Estimaciones
                    </td>
                    <td>
                      <form  class="orb-form">
                      <label class="toggle box">
                            @if($permisos[2]->estado == 1)
                              <input type="checkbox" id="tres" class="cambioPermiso" checked  data-id="{{$permisos[2]->id}}">
                            @else
                              <input type="checkbox" id="tres" class="cambioPermiso" data-id="{{$permisos[2]->id}}">
                            @endif
                            <i></i>
                          </label>
                      </form>  
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Nueva estimacion
                    </td>
                    <td>
                      <form  class="orb-form">
                      <label class="toggle box">
                            @if($permisos[3]->estado == 1)
                              <input type="checkbox" id="cuatro" class="cambioPermiso" checked  data-id="{{$permisos[3]->id}}">
                            @else
                              <input type="checkbox" id="cuatro" class="cambioPermiso" data-id="{{$permisos[3]->id}}">
                            @endif
                            <i></i>
                          </label>
                      </form>
                    </td>
                  </tr>
                   <tr>
                    <td rowspan="2">Contratistas</td>
                    <td>
                      Contratistas
                    </td>
                    <td>
                      <form  class="orb-form">
                      <label class="toggle box">
                            @if($permisos[4]->estado == 1)
                              <input type="checkbox" id="cinco"  class="cambioPermiso" checked  data-id="{{$permisos[4]->id}}">
                            @else
                              <input type="checkbox" id="cinco" class="cambioPermiso" data-id="{{$permisos[4]->id}}">
                            @endif
                            <i></i>
                          </label>
                      </form>  
                    </td>
                  </tr>
                  <tr>
                    <td>Nuevo Contratistas</td>
                    <td>
                      <form  class="orb-form">
                      <label class="toggle box">
                            @if($permisos[5]->estado == 1)
                              <input type="checkbox" id="seis" class="cambioPermiso" checked data-id="{{$permisos[5]->id}}" >
                            @else
                              <input type="checkbox"  id="seis" class="cambioPermiso" data-id="{{$permisos[5]->id}}">
                            @endif
                            <i></i>
                          </label>
                      </form>  
                    </td>
                  </tr>
                   <tr>
                    <td rowspan="3">Usuarios</td>
                    <td>
                      Alta
                    </td>
                    <td>
                      <form  class="orb-form">
                      <label class="toggle box">
                            @if($permisos[6]->estado == 1)
                              <input type="checkbox" id="siete" class="cambioPermiso" checked data-id="{{$permisos[6]->id}}">
                            @else
                              <input type="checkbox" id="siete" class="cambioPermiso" data-id="{{$permisos[6]->id}}">
                            @endif
                            <i></i>
                          </label>
                      </form>  
                    </td>
                  </tr>
                  <tr>
                     <td>
                      Lista
                    </td>
                    <td>
                      <form  class="orb-form">
                      <label class="toggle box">
                            @if($permisos[7]->estado == 1)
                              <input type="checkbox" id="ocho" class="cambioPermiso" checked data-id="{{$permisos[7]->id}}">
                            @else
                              <input type="checkbox" id="ocho" class="cambioPermiso" data-id="{{$permisos[7]->id}}">
                            @endif
                            <i></i>
                          </label>
                      </form>  
                    </td>
                  </tr>
                  <tr>
                     <td>
                      Permisos
                    </td>
                    <td>
                      <form  class="orb-form">
                      <label class="toggle box">
                            @if($permisos[8]->estado == 1)
                              <input type="checkbox" id="nueve" class="cambioPermiso" checked  data-id="{{$permisos[8]->id}}">
                            @else
                              <input type="checkbox" id="nueve" class="cambioPermiso" data-id="{{$permisos[8]->id}}">
                            @endif
                            <i></i>
                          </label>
                      </form>  
                    </td>
                  </tr>
                  
                </table>
                <div class="page-header"></div>
                 <div style="display:none;" class="alert alert-warning alert-dismissible" role="alert"></div>
                <button style="float:right;" id="botonCambiarPermisos" class="btn btn-success">Guardar cambios</button>
            </div>