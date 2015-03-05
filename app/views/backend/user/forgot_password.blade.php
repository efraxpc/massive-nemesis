@extends('Backend/User/layout_login')
@section('content')
<div id="login-page">
    <div class="container">
            <form method="POST" class="form-login" action="{{ URL::to('/users/forgot_password') }}" accept-charset="UTF-8">
                <h2 class="form-login-heading">Reiniciar Contraseña</h2>
                <input type="hidden"  name="_token" value="{{{ Session::getToken() }}}">

                <div class="login-wrap">

                        <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}" autofocus>
                        <br/>
                        <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> {{{ Lang::get('confide::confide.forgot.submit') }}}</button>
                        <hr/>
                        <div class="registration">
                            {{{Lang::get('main.create_account_above_message')}}}<br/>
                            <a class="" href="{{URL::route('create_user')}}">
                                {{{Lang::get('main.create_an_ccount')}}}<br/>
                            </a>
                        </div>
                </div>

                @if (Session::get('error'))
                <div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
                @endif

                @if (Session::get('notice'))
                <div class="alert">{{{ Session::get('notice') }}}</div>
                @endif
            </form>

            <!-- Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Forgot Password ?</h4>
                        </div>
                        <div class="modal-body">
                            <p>Enter your e-mail address below to reset your password.</p>
                            <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                            <button class="btn btn-theme" type="button">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->
        </form>
    </div>
</div>
@stop