<?php

class TipoDeSangre extends Eloquent {

    protected $table = 'tipo_de_sangre';

    public function User() {
        return $this->belongsTo('User', 'user_id');
    }
}