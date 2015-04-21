<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * AdminController Class
 *
 * Implements actions regarding user management
 */
class AdminController extends Controller
{
    private $array_datos = array();
    public function ajax_change_status_user()
    {
        $id = Input::get('id_user');
        $switch_active_value = Input::get('switch_active_value');
        DB::select('CALL update_role_user(?,?)',array($id,$switch_active_value));
    }

    public function ajax_set_user_as_admin()
    {
        $user              = new User();
        $id_user_entrante  = Input::get('id_user');
        $boolean_parameter = Input::get('boolean_parameter');
        $user->userAsAdminOrNot($id_user_entrante,$boolean_parameter);
    }

    public function ajax_delete_user()
    {
        $id = Input::get('id_user');
        DB::select('CALL delete_user(?)',array($id));
    }

    public function ajax_permissions_create_admin()
    {
        $switch_active_value = Input::get('switch_active_value');
        DB::select('CALL update_permissions_create_admin_(?)',array($switch_active_value));
    }

    public function doLogin()
    {     
        return Redirect::to_action('Users@main');
    }

    public function administrar_usuarios()
    {
        $User            = new User();
        $users           = DB::select('CALL select_users()');
        $assigned_roles  = DB::select('CALL select_assigned_roles()');
        $id = Auth::id();
        $select_admin_status_from_users = DB::select(' CALL select_admin_status_from_users()');
        $string_mail_admin_root = $User->stringMailAdminRoot();
        $select_active_status_from_users = $User->activeStatusFromUsers();

        $array_datos['users']   = $users;
        $array_datos['user_id'] = $id;
        $array_datos['admin_status_from_users']     = $select_admin_status_from_users;
        $array_datos['string_mail_admin_root']      = $string_mail_admin_root;
        $array_datos['assigned_roles']              = $assigned_roles;
        $array_datos['active_status_from_users']    = $select_active_status_from_users;

        //dd($array_datos['active_status__from_users']);die;

        return View::make('backend.admin.administrar_usuarios', $array_datos);
    }
}