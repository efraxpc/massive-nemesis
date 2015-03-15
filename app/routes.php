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

// Confide routes
Route::group(array('prefix' => 'usuario'), function()
{
	Route::get('/',  array('as' => 'login','uses' =>'UsersController@login'));
	Route::post('/', 'UsersController@doLogin');
	Route::get('create',  array('as' => 'create_user', 	'uses' =>	'UsersController@create'));
	Route::get('editar/{id}', 'UsersController@edit');
	Route::post('editar/usuario',  array('as' => 'users.update', 'uses' =>	'UsersController@update'));
	Route::post('pipo', 'UsersController@store');
	Route::get('confirm/{code}', 'UsersController@confirm');
	Route::get('forgot_password', 'UsersController@forgotPassword');
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