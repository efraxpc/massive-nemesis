<?php  
	class Archivo extends Eloquent {

	    protected $table = 'files';

	    public function user(){
	    	return $this->belongsTo('User');
	    }
	}