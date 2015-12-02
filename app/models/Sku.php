<?php 
 
class Sku extends Eloquent {
	
	protected $table = "sku";
	protected $fillable = array('cod_sku', 'productos_id');
    protected $primaryKey = 'id';
    
	public function Productos()
    {
        return $this->belongsTo('Productos', 'productos_id');
    }
 

}
?>