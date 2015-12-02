<?php 
 
class Unidades extends Eloquent {
	
	protected $table = "unidades";
	protected $fillable = array('id','nombre', 'abreviatura');
    protected $primaryKey = 'id';
    
    public function Materias()
    {
        return $this->hasOne('Materias'); /*relacion 1-1 */
    }

}
?>