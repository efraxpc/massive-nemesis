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

    public function userAsAdminOrNot($id_user_entrante,$boolean_parameter)
    {
        return DB::select('CALL set_user_as_admin_or_not(?,?)',array($id_user_entrante,$boolean_parameter));
    }
}