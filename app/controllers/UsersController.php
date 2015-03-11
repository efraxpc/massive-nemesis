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
        return View::make('backend.user.create_admin');
    }

    /**
     * Stores new account
     *
     * @return  Illuminate\Http\Response
     */
    public function store()
    {
        //////////////// ERRor Handling///////////
        if (Input::all()['tipo'] == 'user') {
            $errors =  array('email'=>'required','eps'=>'required','serial_marco'=>'required','fecha_nacimiento'=>'required','password'=>'confirmed','password'=>'required');
            $validator = Validator::make(Input::all(), $errors);

            if ($validator->fails())
            {
                return Redirect::to('usuario/create')->withErrors($validator);
            }
        }elseif(Input::all()['tipo'] == 'admin'){
            $errors =  array('email'=>'required','password'=>'confirmed','password'=>'required');
            $validator = Validator::make(Input::all(), $errors);
            
            if ($validator->fails())
            {
                return Redirect::to('usuario/crear/admin')->withErrors($validator);
            }
        }
        /////////////////
        $repo = App::make('UserRepository');
        $user = $repo->signup(Input::all());

        if ($user->id) {
            if (Config::get('confide::signup_email')) {
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
            if (Input::all()['tipo'] == 'user') {
                $role = Role::where('name','=','users')->first();
                $user->roles()->attach($role->id); 
            }elseif(Input::all()['tipo'] == 'admin'){
                $role = Role::where('name','=','admin')->first();
                $user->roles()->attach($role->id);
            }
            return Redirect::action('UsersController@login')
                ->with('notice', Lang::get('confide::confide.alerts.account_created'));
        } else {      
            $error = $user->errors()->all(':message');
            return Redirect::action('UsersController@create')
                ->withInput(Input::except('password'))
                ->with('error', $error);
        }
    }
    //método para actualizar un post, si se hace una petición post se ejecuta el
    //formulario, en otro caso se muestra la vista normal
    public function update($id)
    {

        $post = Post::find($id);//obtenemos el post que queremos actualizar o mostrar
        if(Input::get())
        {

            //si existe el post a editar lo hacemos
            if($post)
            {

                if($this->validateForms(Input::all()) === true)
                {

                     $post->title = Input::get("title");
                     $post->content = Input::get("content");

                     if($post->save())
                     {

                         return Redirect::to('crud/show')->with(array('mensaje' => 'El post se ha actualizado correctamente.'));

                     }

                }else{

                    return Redirect::to("crud/update/$id")->withErrors($this->validateForms(Input::all()))->withInput();

                }

            }else{

                return Redirect::to('crud/show')->with(array('mensaje' => 'El post no existe.'));
                
            }

        }else{

            return View::make("crud/update", array("post" => $post));
            
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
                //return Redirect::intended('users/profile/admin');
                return View::make('backend.admin.home_admin');
                
            }else{
                //return Redirect::intended('users/profile');
                return View::make('backend.admin.home_user');
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
            return Redirect::intended('backend.admin.home_user');
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

        return Redirect::to('/');
    }
}
