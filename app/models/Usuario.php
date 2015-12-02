<?php  
class Usuario extends Eloquent {
	protected $table = "users";

	public function Orden()
    {			
        return $this->HasMany('Orden');	
    }


}