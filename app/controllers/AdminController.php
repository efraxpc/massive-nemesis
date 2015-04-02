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

    public function ajax_delete_user(){
      $id = Input::get('id_user');
      $delete_user = DB::select('CALL delete_user(?)',array($id));
    }

    public function ajax_permissions_create_admin(){
      $switch_active_value = Input::get('switch_active_value');
      $can = DB::select('CALL update_permissions_create_admin_(?)',array($switch_active_value));
    }

    public function doLogin()
    {     
      return Redirect::to_action('Users@main');
    }

    public function administrar_usuarios()
    {
      $users = DB::select('CALL select_users()');
      $assigned_roles = DB::select('CALL select_assigned_roles()');
      $id = Auth::id();
      $array = array('users' => $users,
                     'assigned_roles' => $assigned_roles,
                     'user_id'             => $id );
      return View::make('backend.admin.administrar_usuarios', $array);
    }

}