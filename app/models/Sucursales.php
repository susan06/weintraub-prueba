<?php 
 
class Sucursales extends Eloquent 
{
	protected $table = "sucursales";
	protected $fillable = array('id','sucursal');
    protected $primaryKey = 'id';
      
    public function Pedidos()
    {
        return $this->hasOne('Pedidos');
    }
   
}
?>