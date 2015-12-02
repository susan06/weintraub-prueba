<?php  
class PlatillosMp extends Eloquent {
	
	protected $table = "platillos_mp";
	protected $fillable = array('id','cantidad_mp','platillos_id', 'materia_prima');
    protected $primaryKey = 'id';    

    public function	Platillos()
    {
        return $this->belongsTo('Platillos', 'platillos_id');
    }
	
	 public function Materias()
    {
        return $this->belongsTo('Materias', 'materia_prima');
    }
 
}
?>