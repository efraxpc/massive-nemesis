<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements ConfideUserInterface
{
    use ConfideUser;
    use HasRole;

    public function archivo(){
    	return $this->hasMany('Archivo','user_id');
    }

    public function stringMailAdminRoot()
    {
        return  DB::select(' CALL select_string_mail_admin_root() ')[0]->email;
    }
}