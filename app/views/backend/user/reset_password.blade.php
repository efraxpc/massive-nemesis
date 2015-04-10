@extends('backend/user/layout_login')
@section('content')
<div id="login-page">
    <div class="container">
        <div class="row mt"></div>
        <div class="row mt"></div>
        <div class="row mt"></div>
        <div class="row mt"></div>
        <form method="POST" class="form-login" action="{{{ URL::route('reset_password_post') }}}" accept-charset="UTF-8">
            <input type="hidden" name="token" value="{{{ $token }}}">
            <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
            <h2 class="form-login-heading">{{{Lang::get('main.reiniciar_contraseña')}}}</h2>

            <div class="login-wrap">

                <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password" autofocus>
                <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation" autofocus>
                <br/>
                <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i>{{{ Lang::get('confide::confide.forgot.submit') }}}</button>
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
        $.backstretch( "{{ asset('assets/img/bike_wallpaper_3.jpg') }}", {speed: 500});
    </script>
@stop