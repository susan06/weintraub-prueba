<?php  
class SubCategorias extends Eloquent {
	
	protected $table = "subcategorias";
	protected $fillable = array('id','name','categorias_id');
    protected $primaryKey = 'id';    

    public function	Categorias()
    {
        return $this->belongsTo('Categorias', 'categorias_id');
    }
	

}
?>