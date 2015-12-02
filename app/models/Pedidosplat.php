<?php  
class Pedidosplat extends Eloquent {
	
	protected $table = "pedidos_plat";
	protected $fillable = array('id','id_platillo','id_pedido','cantidad');
    protected $primaryKey = 'id';    

    public function	Pedidos()
    {
        return $this->belongsTo('Pedidos', 'id_pedido');
    }

    public function	Platillos()
    {
        return $this->belongsTo('Platillos', 'id_platillo');
    }
	

}
?>