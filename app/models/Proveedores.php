<?php 
 
class Proveedores extends Eloquent {
	
	protected $table = "proveedores";
	protected $fillable = array('id','nombre', 'empresa', 'telefono', 'direccion', 'notas');
    protected $primaryKey = 'id';

    public function EmpaquesMp()
    {
        return $this->hasOne('EmpaquesMp');
    }
    

}
?>