<?php  
class Proyecto extends Eloquent {
	protected $table = "proyectos";
	public static function buscarObra ($obra) {
		$o = Proyecto::where("obra","like",$obra."%")->get();
		return $o;
	}
}
?>