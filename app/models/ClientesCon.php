<?php  
class ClientesCon extends Eloquent {
	
	protected $table = "clientes_con_credito";
	protected $fillable = array('idcliente');
    protected $primaryKey = 'idcliente';
    
	
}
?>