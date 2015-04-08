<?php
/**
 * UsersController Class
 *
 * Implements actions regarding user management
 */
class UsersController extends Controller
{

    /**
     * Displays the form for account creation
     *
     * @return  Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_de_sangre = DB::table('tipo_de_sangre')->orderBy('nombre', 'asc')->lists('nombre','id');
        return View::make('backend.admin.users', array('tipo_de_sangre' => $tipo_de_sangre));
    }

    /**
     * Displays the form for admin account creation
     *
     * @return  Illuminate\Http\Response
     */
    public function createAdmin()
    {
        $select_habilitar_registro_admin_option = DB::select('call select_habilitar_registro_admin_option()');
        if ($select_habilitar_registro_admin_option[0]->confirmed == 1) {
            return View::make('backend.user.create_admin');
        }elseif($select_habilitar_registro_admin_option[0]->confirmed == 0){
            return Redirect::route('404');
        }
    }

    /**
     * Stores new account
     *
     * @return  Illuminate\Http\Response
     */
    public function store()
    {
        $repo = App::make('UserRepository');
        $user = $repo->signup(Input::all());

        if ($user->id) {
            if ( Config::get('confide::signup_email') ) {
                Mail::queueOn(
                    Config::get('confide::email_queue'),
                    Config::get('confide::email_account_confirmation'),
                    compact('user'),
                    function ($message) use ($user) {
                        $message
                            ->to($user->email, $user->username)
                            ->subject(Lang::get('confide::confide.email.account_confirmation.subject'));
                    }
                );
            }
            $user_id = $user->id;
            if ( Input::all()['tipo'] == 'user' ) {
                $role = Role::where('name','=','users')->first();
                $user->roles()->attach($role->id);
                $slug = 'user';

                $qrcode = $user->qrcode;
                $nome = Request::root().'/usuario/mostrar/'.$qrcode;
                $file = Request::root().'/uploads/qrcodes/'.$qrcode.'.png';

                //Escribir qrcode in server
                $url = 'https://chart.googleapis.com/chart?';
                $chs = 'chs=300x300';
                $cht = 'cht=qr';
                $chl = 'chl='.urlencode($nome);
                $qstring = $url ."&". $chs ."&". $cht ."&". $chl;       
                $data = file_get_contents($qstring);
                $f = fopen('uploads/qrcodes/'.$qrcode.'.png', 'w');
                fwrite($f, $data);
                fclose($f);

                $assigned_roles = DB::select( 'CALL insert_aux_role_in_assigned_roles_table(?,?)',array( $user_id,$slug ) );

            }elseif( Input::all()['tipo'] == 'admin' ){
                $role = Role::where('name','=','admin')->first();
                $user->roles()->attach($role->id);
                $slug = 'admin';
                $assigned_roles = DB::select( 'CALL insert_aux_role_in_assigned_roles_table(?,?)',array( $user_id,$slug ) );
            }
            return Redirect::action('UsersController@login')
                ->with('notice', Lang::get('confide::confide.alerts.account_created'));
        } else {      
            if ( Input::all()['tipo'] == 'user') {
                $errors =  array('email' => 'required|email|unique:users','eps'=>'required','serial_marco'=>'required','fecha_nacimiento'=>'required','password'=>'confirmed','password'=>'required');
                $validator = Validator::make( Input::all(), $errors );            
                return Redirect::route( 'register_user_get' )->withErrors( $validator )->withInput(Input::except('password'));
            }elseif( Input::all()['tipo'] == 'admin' ){
                $errors =  array('email' => 'required|email|unique:users','password'=>'confirmed','password'=>'required');
                $validator = Validator::make( Input::all(), $errors );  
                return Redirect::route( 'register_admin_get' )->withErrors( $validator )->withInput(Input::except('password'));
            }
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        if (is_null($user))
        {
            return Redirect::route('login');
        }
        $tipo_de_sangre = DB::table('tipo_de_sangre')->orderBy('nombre', 'asc')->lists('nombre','id');

        $files = DB::table('users')
            ->join('files', 'users.id', '=', 'files.user_id')
            ->select('files.id','files.nombre','files.tipo')
            ->where('files.user_id', $user->id)
            ->get();
        $array = array('tipo_de_sangre' => $tipo_de_sangre,
                      'user'            => $user,
                      'files'            => $files,);
        return View::make('backend.user.edit', $array);
    }

    public function storeEdit()
    {     
        $id = Input::all()['id'];
        //////////////// ERRor Handling///////////
        $errors =  array('email' => 'required|email|','eps'=>'required','serial_marco'=>'required','fecha_nacimiento'=>'required');
        $validator = Validator::make(Input::all(), $errors);
        if ($validator->fails())
        {
            return Redirect::route('edit_user', array('id' => $id))->withErrors($validator);
        }      
        /////////////////
        $repo = App::make('UserRepository');
        $user = User::find($id); 
        $user->email = Input::all()['email'];  
        $pieces = explode("/", Input::all()['fecha_nacimiento']);
        $dia  = $pieces[0];
        $mes  = $pieces[1];
        $anio = $pieces[2]; 
        $user->fecha_nacimiento = \Carbon\Carbon::createFromDate($anio,$mes,$dia)->toDateTimeString();
        $user->grupo_sanguineo_id = Input::all()['grupo_sanguineo_id'];
        $user->eps = Input::all()['eps'];
        $user->observaciones_generales = Input::all()['observaciones_generales'];
        $user->facebook = Input::all()['facebook'];
        $user->twitter = Input::all()['twitter'];
        $user->serial_marco = Input::all()['serial_marco'];
        $user->lat = Input::all()['lat'];
        $user->lng = Input::all()['lng'];

        $user->save();

        $error = $user->errors()->all(':message');

        if (!is_null($error)) {
            $id = Auth::id();
            $qrcode = $user->qrcode;
            $file = Request::root().'/uploads/qrcodes/'.$qrcode.'.png';
            $array = array('id'=>$id,'user'=>$user,'file'=>$file);
            return View::make('backend.user.home_user', $array);
        }else{

            return Redirect::action('UsersController@edit')
                ->withInput(Input::except('password'))
                ->with('error', $error);
        }

    }

    /**
     * Displays the login form
     * @return  Illuminate\Http\Response
     */
    public function login()
    {
        $user = Auth::user();
        if(!empty($user->id)){
            return View::make('backend.user.login');
        }
        return View::make('backend.user.login');
    }

    /**
     * Attempt to do login
     * @return  Illuminate\Http\Response
     */
    public function doLogin()
    {
        $repo = App::make('UserRepository');
        $input = Input::all();
        if ($repo->login($input)) {
            if(Entrust::hasRole('admin')) {
                $id = Auth::id();
                $user  = User::find($id);
                $select_habilitar_registro_admin_option = DB::select('call select_habilitar_registro_admin_option()');
                $array = array('habilitar_registro_admin_option'=>$select_habilitar_registro_admin_option[0]->confirmed);
                return View::make('backend.admin.home_admin')->withUser($user)->with($array);
            }else{
                $id = Auth::id();
                $user  = User::find($id);
                $qrcode = $user->qrcode;
                $file = Request::root().'/uploads/qrcodes/'.$qrcode.'.png';                
                $array = array('id'=> $id,
                               'file'=> $file);

                return View::make('backend.user.home_user')->with($array)->withUser($user);
            }
        } else {
            if ($repo->isThrottled($input)) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ($repo->existsButNotConfirmed($input)) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            return Redirect::action('UsersController@login')
                ->withInput(Input::except('password'))
                ->with('error', $err_msg);
        }
    }

    /**
     * PostLogin action
     * @return  Illuminate\Http\Response
     */
    public function postLogin()
    {
        if(Entrust::hasRole('admin')) {
            return View::make('backend.admin.home_admin');
        }elseif(Entrust::hasRole('user')){
            return Redirect::intended('backend.user.home_user');
        }
    }

    /**
     * Attempt to confirm account with code
     * @param  string $code
     * @return  Illuminate\Http\Response
     */
    public function confirm($code)
    {
        if (Confide::confirm($code)) {
            $notice_msg = Lang::get('confide::confide.alerts.confirmation');
            return Redirect::action('UsersController@login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
            return Redirect::action('UsersController@login')
                ->with('error', $error_msg);
        }
    }

    /**
     * Displays the forgot password form
     *
     * @return  Illuminate\Http\Response
     */
    public function forgotPassword()
    {
        return View::make('backend.user.forgot_password');
    }

    /**
     * Attempt to send change password link to the given email
     *
     * @return  Illuminate\Http\Response
     */
    public function doForgotPassword()
    {
        if (Confide::forgotPassword(Input::get('email'))) {
            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
            return Redirect::action('UsersController@login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
            return Redirect::action('UsersController@doForgotPassword')
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Shows the change password form with the given token
     *
     * @param  string $token
     *
     * @return  Illuminate\Http\Response
     */
    public function resetPassword($token)
    {
        return View::make('backend.user.reset_password')->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     * @return  Illuminate\Http\Response
     */
    public function doResetPassword()
    {
        $repo = App::make('UserRepository');
        $input = array(
            'token'                 =>Input::get('token'),
            'password'              =>Input::get('password'),
            'password_confirmation' =>Input::get('password_confirmation'),
        );

        // By passing an array with the token, password and confirmation
        if ($repo->resetPassword($input)) {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
            return Redirect::action('UsersController@login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
            return Redirect::action('UsersController@resetPassword', array('token'=>$input['token']))
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return  Illuminate\Http\Response
     */
    public function logout()
    {
        Confide::logout();
        return Redirect::route('login');
    }

    /**
     * Mostrar
     *
     * @return  Illuminate\Http\Response
     */
    public function mostrar($qrcode)
    {
        $user = DB::table('users')->where('qrcode', $qrcode)->first();
        $grupo_sanguineo_id = $user->grupo_sanguineo_id;

        $grupo_sanguineo = TipoDeSangre::find($grupo_sanguineo_id);
        $nome=Request::root().'/usuario/mostrar/'.$qrcode;
        $qrcode = $user->qrcode;
        $file = Request::root().'/uploads/qrcodes/'.$qrcode.'.png';
        $imagenes_de_usuario = DB::select('call select_imagenes_de_usuario(?)',array($user->id));    
        return View::make('backend.user.mostrar',['user' =>$user,'grupo_sanguineo'=>$grupo_sanguineo,'file'=>$file,'imagenes_de_usuario'=>$imagenes_de_usuario]);
    }

    /**
     * Mostrar pagina inical
     *
     * @return  Illuminate\Http\Response
     */
    public function main()
    {
        $id = Auth::id();
        $user = DB::table('users')->find($id);
        $tipo_de_sangre = DB::table('tipo_de_sangre')->orderBy('nombre', 'asc')->lists('nombre','id');
        $select_habilitar_registro_admin_option = DB::select('call select_habilitar_registro_admin_option()');

        $qrcode = $user->qrcode;
        $file = Request::root().'/uploads/qrcodes/'.$qrcode.'.png';

        $array = array('user' => $user,
                       'tipo_de_sangre' => $tipo_de_sangre,
                       'id'             => $id,
                       'file'           => $file,
                       'habilitar_registro_admin_option'=>$select_habilitar_registro_admin_option[0]->confirmed );

        $select_role_of_user = DB::select('CALL select_role_of_user(?)',array($id));
        $rol_usuario = $select_role_of_user[0]->rol_usuario;

        if ($rol_usuario == 'admin') {
            return View::make('backend.admin.home_admin',$array);
        }else{
            return View::make('backend.user.home_user',$array);
        }
    }
}
