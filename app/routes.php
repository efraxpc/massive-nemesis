<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::get('/', function(){	return View::make('backend.user.login');});
Route::filter('admin_owner', function()
{
    if (!Entrust::hasRole('admin')) {
        App::abort(403);
    }

});

Route::filter('user_owner', function()
{
    if (!Entrust::hasRole('users')) {
        App::abort(403);
    }

});
// only owners will have access to routes within admin/advanced
Route::when('admin*'   , 'admin_owner');
Route::when('usuario*' , 'user_owner');

Route::get('/datatable', function(){	
	return View::make('backend.datatable');
});
Route::get('/upload', function(){ return View::make('backend.user.create_image'); });
Route::post('upload', 'FileController@upload_image');
Route::post('ajax_remove_image', 'FileController@remove_image');
Route::post('/ajax_change_status_user', 'AdminController@ajax_change_status_user');
Route::post('/ajax_delete_user', 'AdminController@ajax_delete_user');
Route::post('/ajax_permissions_create_admin', 'AdminController@ajax_permissions_create_admin');
Route::post('inicio/post',  			array('as' 		=> 'login_post','uses' 	=>'UsersController@doLogin'));
Route::get('/inicio/',  			    array('as' 		=> 'main','uses' 		=>'UsersController@main'));
Route::get('/',  						array('as' 		=> 'login','uses' 		=>'UsersController@login'));
Route::get('/cerrar/sesion',  			array('as' 		=> 'logout','uses' 		=>'UsersController@logout'));
Route::get('crear/usuario',  			array('as' 		=> 'register_user_get','uses'   =>	'UsersController@create'));
Route::post('guardar/usuario',			array('as' 		=> 'guardar_usuario','uses' 	=>	'UsersController@store'));
Route::get('/mostrar/{qrcode}',  		array('as' 		=> 'mostrar','uses' 	=>'UsersController@mostrar'));
Route::get('confirmar/{code}', 'UsersController@confirm');
Route::get('forgot_password',  			array('as' 		=> 'forgot_password_get','uses'     =>	'UsersController@forgotPassword'));
Route::post('forgot_password',			array('as' 		=> 'forgot_password_post','uses' 	=>	'UsersController@doForgotPassword'));
Route::get('reiniciar/contraseña/{token}', 'UsersController@resetPassword');
Route::post('resetear_password',			array('as' 	=> 'reset_password_post','uses' 	=>	'UsersController@doResetPassword'));
Route::get('logout', 'UsersController@logout');
Route::get('/delete/files', function(){DB::table('files')->delete(); });

Route::group(array('prefix' => 'admin'), function()
{
	Route::get('/home',  					                array('as' => 'login_admin','uses' 	           =>'AdminController@doLogin'));
	Route::get('/administrar/usuarios',  	                array('as' => 'administrar_usuarios','uses'    =>'AdminController@administrar_usuarios'));
	Route::get('/crear',  					                array('as' => 'register_admin_get','uses'    		=>'UsersController@createAdmin'));
	Route::get('profile/admin', 'UsersController@postLogin');
    Route::get('editar/usuario/{id}/{admin?}',  			array('as' 		=> 'edit_user_from_admin','uses' 	=>'UsersController@edit'));
    Route::post('editado/',  				                array('as' 		=> 'admin_editar_usuario','uses' 	=>'UsersController@storeEdit'));
});

Route::when('admin/*', 'admin');
//Rudas usuario
Route::group(array('prefix' => 'usuario'), function()
{
	Route::post('imprimir',  						array('as' 		=> 'imprimir','uses' 	=>'FileController@imprimir'));
	Route::get('/generar_qr/{qrcode}',  			array('as' 		=> 'generar_qr','uses'  =>'UsersController@generate_qr'));
	Route::get('editar/{id}',  						array('as' 		=> 'edit_user','uses' 	=>	'UsersController@edit'));
	Route::get('editar/imagen/{id}',  				array('as' 		=> 'edit_imagen_user','uses' 	=>	'FileController@edit_imagen'));
	Route::post('editado',  						array('as' 		=> 'editar_usuario','uses' 		=>	'UsersController@storeEdit'));
	Route::get('cambiar/foto/perfil',  				array('as' 		=> 'cambiar_foto_perfil','uses' =>	'FileController@cambiar_foto_perfil'));
});



 App::error(function($exception, $code)
 {
     switch ($code)
     {
         case 403:
             return Response::view('backend.errors.home_403', array(), 403);

         case 404:
             return Response::view('backend.errors.home_404', array(), 404);

         case 500:
             return Response::view('backend.errors.home_500', array(), 500);

         default:
             return Response::view('errors.default', array(), $code);
     }
 });

Route::get('/teste_role',function(){
	$user = Auth::user();//obtenemos el usuario logueado
	if ($user->hasRole('users'))
	{
		return "usuario tiene rol user!";
	}elseif($user->hasRole('admin'))
	{
		return "usuario tiene rol admin!";
	}else{
		echo "nada!!";
	}
});

Route::get('/asignar_role_admin',function(){
	$user = DB::table('users')->where('name', 'John')->first();
	$role = Role::where('name','=','users')->first();
	$user->roles()->attach($role->id);
});


	// Route::get('/permissions',function()
	// {

	// 	$admin = new Role;
	// 	$admin->name = 'admin';
	// 	$admin->save();
		
	// $admin = new Role;
	// $admin->name = 'redemption';
	// $admin->save();

	// 	$user = new Role;
	// 	$user->name = 'users';
	// 	$user->save();

		
	// 	$manageProfile = new Permission; // Can edit, delete & enter data.
	// 	$manageProfile->name = 'manage_profile';
	// 	$manageProfile->display_name = 'Manage Profile';
	// 	$manageProfile->save();
		
	  
	// 	$manageUsers = new Permission;
	// 	$manageUsers->name = 'manage_users';
	// 	$manageUsers->display_name = 'Manage Users';
	// 	$manageUsers->save();

	// 	$admin->perms()->sync(array($manageUsers->id));
	// 	$user->perms()->sync(array($manageProfile->id));
		
	
	//});