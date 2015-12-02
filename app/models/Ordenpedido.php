<?php  
class Ordenpedido extends Eloquent {
	
	protected $table = "orden_ped";
	protected $fillable = array('id','id_orden','id_pedido');
    protected $primaryKey = 'id';    

    public function	Pedidos()
    {
        return $this->belongsTo('Pedidos', 'id_pedido');
    }

    public function Orden()
    {
        return $this->belongsTo('Orden', 'id_orden');
    }

   

}
?>