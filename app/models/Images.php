<?php

class Images extends \Eloquent {

	// Add your validation rules here

	protected $table = 'images_product';

	protected $fillable = array('id','productos_id','public_filename','filename');
	protected $primaryKey = 'id';
	
    public function Productos()
    {
        return $this->belongsTo('Productos', 'productos_id');
    }
    
}
