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

Route::get('/resize', function()
{
    $img = Image::make(public_path().'/uploads/'.'imagen__55146a4612175.cartera.jpg')->resize(300, 200);
    $img->save(public_path().'/uploads/ded.jpg');


    return $img->response('jpg');
});
Route::get('/demo', function()
{
	return View::make('backend.demo');
});
Route::get('/upload', function()
{
	return View::make('backend.user.create_image');
});
Route::post('upload', 'FileController@upload_image');
// Confide routes
Route::group(array('prefix' => 'usuario'), function()
{
	Route::get('/mostrar/{qrcode}',  array('as' => 'mostrar','uses' =>'UsersController@mostrar'));

	Route::get('/',  array('as' => 'login','uses' =>'UsersController@login'));
	Route::post('/', 'UsersController@doLogin');

	Route::get('create',  array('as' => 'create_user', 	'uses' =>	'UsersController@create'));
	Route::get('/generar_qr/{qrcode}',  array('as' => 'generar_qr','uses' =>'UsersController@generate_qr'));

	Route::get('editar/{id}',  array('as' => 'edit_user','uses' =>	'UsersController@edit'));
	Route::get('editar/imagen/{id}',  array('as' => 'edit_imagen_user','uses' =>	'FileController@edit_imagen'));
	Route::post('pipo', 'UsersController@store');
	Route::post('pipo2',  array('uses' =>	'UsersController@storeEdit'));
	
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