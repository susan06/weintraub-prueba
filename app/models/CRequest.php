<?php

class CRequest extends Eloquent
{

    protected $table = 'crequests';
    protected $fillable = array('id');
    protected $primaryKey = 'id';
    

    public function User()
    {
        return $this->belongsTo('User');
    }
}
