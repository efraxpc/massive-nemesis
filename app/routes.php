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

Route::get('/', function()
{
	return View::make('backend.user.login');
});

Route::get('/qr', function()
{
    //salvamos la imagen
    //los parametros son, data, tipo, ancho, alto y un array con el color en formato rgb
    DNS2D::getBarcodePngPath("unodepiera", "QRCODE", 7, 7, array(255,0,0));
    echo "<img src='unodepiera.png' />";
 
});

// Confide routes
Route::group(array('prefix' => 'usuario'), function()
{
	Route::get('/',  array('as' => 'login','uses' =>'UsersController@login'));
	Route::post('/', 'UsersController@doLogin');

	Route::get('create',  array('as' => 'create_user', 	'uses' =>	'UsersController@create'));

	Route::get('editar/{id}',  array('as' => 'edit_user','uses' =>	'UsersController@edit'));
	Route::post('pipo', 'UsersController@store');
	Route::post('pipo2',  array('uses' =>	'UsersController@storeEdit'));
	
	Route::get('confirm/{code}', 'UsersController@confirm');
	Route::get('forgot_password', 'UsersControllerforgotPassword');
	Route::post('forgot_password', 'UsersController@doForgotPassword');
	Route::get('reset_password/{token}', 'UsersController@resetPassword');
	Route::post('resetear_password', 'UsersController@doResetPassword');
	Route::get('logout', 'UsersController@logout');
	Route::get('crear/admin', 'UsersController@createAdmin');
	Route::get('profile/admin', 'UsersController@postLogin');
});

// App::error(function($exception, $code)
// {
//     switch ($code)
//     {
//         case 403:
//             return Response::view('backend.errors.home_403', array(), 403);

//         case 404:
//             return Response::view('backend.errors.home_404', array(), 404);

//         case 500:
//             return Response::view('backend.errors.home_500', array(), 500);

//         default:
//             return Response::view('errors.default', array(), $code);
//     }
// });

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
		
	
	// });