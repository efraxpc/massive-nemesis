@extends('backend/user/layout_login')
@section('content')
<div id="login-page">
    <div class="container">
        <div class="row mt"></div>
        <div class="row mt"></div>
        <div class="row mt"></div>
        <div class="row mt"></div>
        <div class="row mt"></div>
        <div class="row mt"></div>

        <form method="POST" class="form-login"action="{{{ URL::route('forgot_password_post') }}}" accept-charset="UTF-8">
            <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
            <h2 class="form-login-heading">{{{Lang::get('main.recuperar_contraseña')}}}</h2>
            <div class="login-wrap">
                <label for="email"><h6><p>{{{Lang::get('main.texto_colocar_email')}}}</p></h6> </label>
                <div class="input-append input-group">
                    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
                    <span class="input-group-btn">
                        <input class="btn btn-default" type="submit" value="{{{ Lang::get('confide::confide.forgot.submit') }}}">
                    </span>
                </div>
            </div>
            @if (Session::get('error'))
                <div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
            @endif

            @if (Session::get('notice'))
                <div class="alert">{{{ Session::get('notice') }}}</div>
            @endif
        </form>


    </div>
</div>
@stop
@section('script_image')
    <script>
        $.backstretch( "{{ asset('assets/img/bike_wallpaper.jpg') }}", {speed: 500});
    </script>
@stop