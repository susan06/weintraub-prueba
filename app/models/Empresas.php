<?php 
 
class Empresas extends Eloquent 
{
	
	protected $table = "empresas";
	protected $fillable = array('id','name');
    protected $primaryKey = 'id_emp';
    
}
?>