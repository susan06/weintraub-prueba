<?php 
 
class Orden extends Eloquent {
	
	protected $table = "orden";
	protected $fillable = array('id','responsable','nombre','sucursal');
    protected $primaryKey = 'id';
    
	
    public function Ordenpedido()
    {			
        return $this->HasMany('Ordenpedido');	
    }

    public function Usuario()
    {
        return $this->belongsTo('Usuario', 'responsable');
    }
 

    
}
?>