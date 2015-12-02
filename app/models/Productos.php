<?php  
class Productos extends Eloquent {
	
	protected $table = "productos";
	protected $fillable = array('id');
    protected $primaryKey = 'id';
    
	public function Images()
    {
        return $this->hasMany('Images');
    }
	
	public function Sku()
    {
        return $this->hasMany('Sku');
    }
	
    public function User()
    {
        return $this->belongsTo('User');
    }

     public function Categorias()
    {
        return $this->belongsTo('Categorias', 'categoria');
    }
	
     public function SubCategorias()
    {
        return $this->belongsTo('SubCategorias', 'subcategoria');
    }
}
?>