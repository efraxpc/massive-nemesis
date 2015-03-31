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
      $id = Auth::id();
      dd($id);
      die;
      $switch_active_value = Input::get('switch_active_value');
      dd($switch_active_value);
      die;
      $update_role_to_redemption = DB::select('CALL update_role_to_redemption(?)',array($id));
    }

    public function doLogin()
    {
      return View::make('backend.admin.home_admin');
    }

    public function administrar_usuarios()
    {
      $users = DB::select('CALL select_users()');
      // dd($users);
      // die;
      $array = array('users' => $users );
      return View::make('backend.admin.administrar_usuarios', $array);
    }

}