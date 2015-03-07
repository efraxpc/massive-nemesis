@extends('backend/user/layout_create')
@section('content')
<div class="row-fluid">
    <div class="col-md-6 col-md-offset-3"">
        <div class="position-relative">
            <div class="signup-box visible widget-box no-border">
                <div class="widget-body">
                    <div class="widget-main">
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <div class="space-6"></div>
                        <p> Ingresa tu información para empezfar: </p>
                        <form method="POST" action="{{{ URL::to('users/pipo') }}}" accept-charset="UTF-8">
                            <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
                            <fieldset>
                                @if (Cache::remember('username_in_confide', 5, function() {
                                    return Schema::hasColumn(Config::get('auth.table'), 'username');
                                }))
                                <div class="form-group">
                                    <label for="username">{{{ Lang::get('confide::confide.username') }}}</label>
                                    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.username') }}}" type="text" name="username" id="username" value="{{{ Input::old('username') }}}">
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="email">{{{ Lang::get('confide::confide.e_mail') }}} <small>{{ Lang::get('confide::confide.signup.confirmation_required') }}</small></label>
                                    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
                                </div>
                                <div class="form-group">
                                    {{ Form::select('grupo_sanguineo_id', $tipo_de_sangre ,Input::old('grupo_sanguineo_id'),array('class'=>'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label for="eps">{{{Lang::get('main.eps')}}}</label>
                                    <input class="form-control" placeholder="{{{Lang::get('main.eps')}}}" type="text" name="eps" id="eps" value="{{{ Input::old('eps') }}}">
                                </div>
                                <div class="form-group">
                                    {{{Lang::get('main.observaciones_generales') }}}
                                    <br>  
                                    {{ Form::textarea('observaciones_generales', null, ['class' => 'form-control', 'placeholder' => "Observaciones Generales" ]) }}
                                </div>
                                <div class="form-group">
                                    <label for="serial_marco">{{{Lang::get('main.serial_marco')}}}</label>
                                    <input class="form-control" placeholder="{{{Lang::get('main.serial_marco')}}}" type="text" name="serial_marco" id="serial_marco" value="{{{ Input::old('serial_marco') }}}">
                                </div>
                                <div class="form-group">
                                    <label for="facebook">{{{Lang::get('main.facebook')}}}</label>
                                    <input class="form-control" placeholder="{{{Lang::get('main.facebook')}}}" type="text" name="facebook" id="facebook" value="{{{ Input::old('facebook') }}}">
                                </div>
                                <div class="form-group">
                                    <label for="twitter">{{{Lang::get('main.twitter')}}}</label>
                                    <input class="form-control" placeholder="{{{Lang::get('main.twitter')}}}" type="text" name="twitter" id="twitter" value="{{{ Input::old('twitter') }}}">
                                </div>
                                <div class="form-group">
                                    <label for="fecha_nacimiento">{{{Lang::get('main.fecha_nacimiento')}}}</label>
                                    <input class="form-control" placeholder="{{{Lang::get('main.fecha_nacimiento')}}}" type="text" name="fecha_nacimiento" id="datepicker" value="{{{ Input::old('fecha_nacimiento') }}}">
                                </div>
                                <div class="form-group">
                                    <label for="password">{{{ Lang::get('confide::confide.password') }}}</label>
                                    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">{{{ Lang::get('confide::confide.password_confirmation') }}}</label>
                                    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
                                </div>

                                @if (Session::get('error'))
                                    <div class="alert alert-error alert-danger">
                                        @if (is_array(Session::get('error')))
                                            {{ head(Session::get('error')) }}
                                        @endif
                                    </div>
                                @endif

                                @if (Session::get('notice'))
                                    <div class="alert">{{ Session::get('notice') }}</div>
                                @endif

                                <div class="form-actions form-group">
                                  <button type="submit" class="btn btn-primary">{{{ Lang::get('confide::confide.signup.submit') }}}</button>
                                </div>
                            </fieldset>
                        </form>

                    </div>
                </div><!--/widget-body-->
            </div><!--/signup-box-->
        </div><!--/position-relative-->
    </div>
</div>
@stop