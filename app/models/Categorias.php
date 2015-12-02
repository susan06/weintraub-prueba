<?php 
 
class Categorias extends Eloquent {
	
	protected $table = "categorias";
	protected $fillable = array('id','name');
    protected $primaryKey = 'id';
    
	
    public function SubCategorias()
    {			
        return $this->HasMany('SubCategorias');	/* relacion de categorias y subcategorias 1-n */
    }

}
?>