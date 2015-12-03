<html>
<meta charset="UTF-8">
<table>
 <tbody>
 
   <tr>
   <td>Datos De la Orden de Compra:</td>
   <td><b>{{$orden->nombre}}</b></td>
   </tr>
   
   <tr>
   <td>Responsable:</td>
   <td><b>{{$orden->Usuario->username}}</b></td>
   </tr>
   
   <tr>
   <td>Fecha:</td>
   <td><b>{{$orden->created_at}}</b></td>
  </tr>
  
   <tr>
   <td></td>
  </tr>
  
  <tr>
   <td><h3>Materia prima necesaria por platillo</h3></td>
  </tr>
  
  <tr>
   <td></td>
  </tr>
  
  <tr>
   <td><b>Pedido</b></td>
   <td><b>Sucursal</b></td>
   <td><b>Platillo</b></td>
   <td><b>Unidades</b></td>
   <td><b>Materia Prima</b></td>
   <td><b>Cantidad (por platillo)</b></td>
  </tr>

     @foreach($ordenpedido as $ord)
    @foreach(Pedidos::where('id','=',$ord->id_pedido)->get() as $ped)
    @foreach(Pedidosplat::where('id_pedido','=',$ped->id)->get() as $pedplat)
      @foreach(Platillos::where('id','=',$pedplat->id_platillo)->get() as $plat)
      @foreach(PlatillosMp::where('platillos_id','=',$plat->id)->get() as $platmp)
        @foreach(Materias::where('id','=',$platmp->materia_prima)->get() as $materia)
        <tr>
          <td>{{$ped->nombre}}</td>
          <td>{{$ped->Sucursales->sucursal}}</td>
          <td>{{$plat->nombre}}</td>
          <td>{{$pedplat->cantidad}}</td>
          <td>{{$materia->nombre}}</td>
          <td>{{$platmp->cantidad_mp}} {{$materia->Unidades->nombre}}</td>
        </tr> 
        @endforeach
      @endforeach
      @endforeach
     @endforeach
    @endforeach
    @endforeach   
   </tbody>
</table>
</html>