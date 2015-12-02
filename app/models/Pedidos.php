<?php 
 
class Pedidos extends Eloquent {
	
	protected $table = "pedidos";
	protected $fillable = array('id','responsable','sucursal','fecha_entrega');
    protected $primaryKey = 'id';
    
	
    public function Pedidosplat()
    {			
        return $this->HasMany('Pedidosplat');	
    }

    public function Ordenpedido()
    {			
        return $this->HasMany('Ordenpedido');	
    }

    public function Sucursales()
    {
        return $this->belongsTo('Sucursales', 'sucursal');
    }

}
?>