<?php 
 
class Empaques extends Eloquent 
{
	
	protected $table = "empaques";
	protected $fillable = array('id','materia_prima');
    protected $primaryKey = 'id';

    public function EmpaquesMp()
    {
        return $this->hasOne('EmpaquesMp');
    }
    public function Materias()
    {
        return $this->belongsTo('Materias', 'materia_prima');
    }

    
}
?>