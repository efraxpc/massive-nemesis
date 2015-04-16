@extends('backend/user/layout_login')
@section('content')
    <div id="login-page">
        <div class="container">
            <form role="form" class="form-login" method="POST" action="{{{ URL::route('login_post') }}}" accept-charset="UTF-8">
            <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
                <h2 class="form-login-heading">{{{Lang::get('main.iniciar_sesion')}}}</h2>
                <div class="login-wrap">
           <fieldset>
                <div class="form-group">
                    <label for="email">{{{ Lang::get('confide::confide.e_mail') }}}</label>
                    <input class="form-control" tabindex="1" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
                </div>
                <div class="form-group">
                <label for="password">
                    {{{ Lang::get('confide::confide.password') }}}
                </label>
                <input class="form-control" tabindex="2" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
                <p class="help-block">
                    <a href="{{{ URL::route('forgot_password_get') }}}">{{{ Lang::get('confide::confide.login.forgot_password') }}}</a>
                </p>
                </div>
                <div class="checkbox">
                    <label for="remember">
                        <input tabindex="4" type="checkbox" name="remember" id="remember" value="1"> {{{ Lang::get('confide::confide.login.remember') }}}
                    </label>
                </div>
                @if (Session::get('error'))
                    <div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
                @endif

                @if (Session::get('notice'))
                    <div class="alert">{{{ Session::get('notice') }}}</div>
                @endif
                <div class="form-group">
                    <input tabindex="3" type="submit" value="{{{Lang::get('main.entrar')}}}" class="btn btn-default"> </input>
                </div>
            </fieldset>
                    <div class="registration">
                        {{{Lang::get('main.todavia_no_tener_cuenta')}}}<br/>
                        <a class="" href="{{URL::route('register_user_get')}}">
                            {{{Lang::get('main.crear_cuenta')}}}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('script_image')
    <script>
        $.backstretch( "{{ asset('assets/img/bike_wallpaper_4.jpg') }}", {speed: 500});
    </script>
@stop