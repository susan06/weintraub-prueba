<?php 
 
class Platillos extends Eloquent {
	
	protected $table = "platillos";
	protected $fillable = array('id','nombre');
    protected $primaryKey = 'id';
    
	
    public function PlatillosMp()
    {			
        return $this->HasMany('PlatillosMp');	/* relacion de categorias y subcategorias 1-n */
    }

     public function Pedidosplat()
    {			
        return $this->HasMany('Pedidosplat');	
    }

}
?>