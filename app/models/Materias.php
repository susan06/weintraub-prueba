<?php 
 
class Materias extends Eloquent {
	
	protected $table = "materia_prima";
	protected $fillable = array('id','nombre', 'unidad');
    protected $primaryKey = 'id';


	public function Unidades()
    {
        return $this->belongsTo('Unidades', 'unidad');
    }

    public function Empaques()
    {
        return $this->hasOne('Empaques');
    }

    public function Platillosmp()
    {
        return $this->HasMany('Platillosmp');
    }


}
?>