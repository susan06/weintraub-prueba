<?php  
class ClientesSin extends Eloquent {
	
	protected $table = "clientes_sin_credito";
	protected $fillable = array('id_cliente');
    protected $primaryKey = 'id_cliente';
    
	
}
?>