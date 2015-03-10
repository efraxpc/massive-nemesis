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
	return View::make('hello');
});
//
// Confide routes
Route::get('users/create',  array('as' => 'create_user', 	'uses' =>	'UsersController@create'));
Route::post('users/pipo', 'UsersController@store');
Route::get('users/login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/resetear_password', 'UsersController@doResetPassword');
Route::get('users/logout', 'UsersController@logout');

Route::get('users/crear/admin', 'UsersController@createAdmin');
Route::get('users/profile', 'UsersController@postLogin');
Route::when('users/profile*', 'owner_role');

Route::filter('owner_role', function()
{
    if (! Entrust::hasRole('admin') ) // Checks the current user
    {
        App::abort(403);
    }
});

App::error(function($exception, $code)
{
    switch ($code)
    {
        case 403:
            return Response::view('backend.errors.home_403', array(), 403);

        case 404:
            return Response::view('backend.errors.home_403', array(), 404);

        case 500:
            return Response::view('errors.500', array(), 500);

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