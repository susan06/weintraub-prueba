<?php 
 
class EmpaquesMp extends Eloquent 
{
	
	protected $table = "empaques_mp";
	protected $fillable = array('id','nombrepaquete','cantidad', 'empaques_id', 'proveedor');
    protected $primaryKey = 'id';
    
    public function Empaques()
    {
        return $this->belongsTo('Empaques', 'empaques_id');
    }

     public function Proveedores()
    {
        return $this->belongsTo('Proveedores', 'proveedor');
    }
}
?>