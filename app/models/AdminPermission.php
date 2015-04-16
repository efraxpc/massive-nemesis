<?php
class AdminPermission extends Eloquent {

    protected $table = 'admin_permission';

    public function habilitar_registro_admin_option()
    {
        return DB::select(' CALL select_habilitar_registro_admin_option() ');
    }
}