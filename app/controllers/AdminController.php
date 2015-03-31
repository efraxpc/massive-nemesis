<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * ProductController Class
 *
 * Implements actions regarding user management
 */
class AdminController extends Controller
{
    public function ajax_change_status_user()
    {
      $id = Input::get('id_user');
      $switch_active_value = Input::get('switch_active_value');

      $update_role_user = DB::select('CALL update_role_user(?,?)',array($id,$switch_active_value));

    }

    public function doLogin()
    {
      return View::make('backend.admin.home_admin');
    }

    public function administrar_usuarios()
    {
      $users = DB::select('CALL select_users()');
      $assigned_roles = DB::select('CALL select_assigned_roles()');
      // dd($assigned_roles);
      // die;
      $array = array('users' => $users,
                     'assigned_roles' => $assigned_roles );
      return View::make('backend.admin.administrar_usuarios', $array);
    }

}