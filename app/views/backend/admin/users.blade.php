@extends('backend/user/layout_create')
@section('content')
<div class="row-fluid">
    <div class="col-md-6 col-md-offset-3">
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
                        <p> Ingresa tu información para empezar: </p>
                        <form method="POST" action="{{{ URL::route('guardar_usuario') }}}" accept-charset="UTF-8">
                            <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
                            <input type="hidden" name="tipo" value="user">
                            <input type="hidden" name="editar" value="false">
                            <fieldset>
                                @if (Cache::remember('username_in_confide', 5, function() {
                                    return Schema::hasColumn(Config::get('auth.table'), 'username');
                                }))
                                <div class="form-group">
                                    <label for="username">{{{ Lang::get('confide::confide.username') }}}</label>
                                    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.username') }}}" type="text" name="username" id="username" value="{{{ Input::old('username') }}}">
                                    @if ($errors->has('username')) 
                                    <div class="alert alert-danger">{{ $errors->first('username')  }}</div> @endif
                                </div>z
                                @endif
                                <div class="form-group">
                                    <label for="email">{{{ Lang::get('confide::confide.e_mail') }}} <small>{{ Lang::get('confide::confide.signup.confirmation_required') }}</small></label>
                                    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
                                    @if ($errors->has('email')) 
                                    <div class="alert alert-danger">{{ $errors->first('email')  }}</div> @endif
                                </div>
                                <div class="form-group">
                                    <label for="nombre_completo">{{{Lang::get('main.nombre_completo')}}}</label>
                                    <input class="form-control" placeholder="{{{Lang::get('main.nombre_completo')}}}" type="text" name="nombre_completo" id="nombre_completo" value="{{{ Input::old('nombre_completo') }}}">
                                    @if ($errors->has('nombre_completo')) 
                                    <div class="alert alert-danger">{{ $errors->first('nombre_completo')  }}</div> @endif
                                </div>
                                <div class="form-group">
                                    {{ Form::select('grupo_sanguineo_id', $tipo_de_sangre ,Input::old('grupo_sanguineo_id'),array('class'=>'form-control')) }}
                                    @if ($errors->has('tipo_de_sangre')) 
                                    <div class="alert alert-danger">{{ $errors->first('tipo_de_sangre')  }}</div> @endif
                                </div>
                                <div class="form-group">
                                    <label for="eps">{{{Lang::get('main.eps')}}}</label>
                                    <input class="form-control" placeholder="{{{Lang::get('main.eps')}}}" type="text" name="eps" id="eps" value="{{{ Input::old('eps') }}}">
                                    @if ($errors->has('eps')) 
                                    <div class="alert alert-danger">{{ $errors->first('eps')  }}</div> @endif
                                </div>
                                <div class="form-group">
                                    {{{Lang::get('main.observaciones_generales') }}}
                                    <br>  
                                    {{ Form::textarea('observaciones_generales', null, ['class' => 'form-control', 'placeholder' => "Observaciones Generales"]) }}
                                    @if ($errors->has('observaciones_generales')) 
                                    <div class="alert alert-danger">{{ $errors->first('observaciones_generales')  }}</div> @endif
                                </div>
                                <div class="form-group">
                                    <label for="serial_marco">{{{Lang::get('main.serial_marco')}}}</label>
                                    <input class="form-control" placeholder="{{{Lang::get('main.serial_marco')}}}" type="text" name="serial_marco" id="serial_marco" value="{{{ Input::old('serial_marco') }}}">
                                    @if ($errors->has('serial_marco')) 
                                    <div class="alert alert-danger">{{ $errors->first('serial_marco')  }}</div> @endif
                                </div>
                                <div class="form-group">
                                    <label for="facebook">{{{Lang::get('main.facebook')}}}</label>
                                    <input class="form-control" placeholder="{{{Lang::get('main.facebook')}}}" type="text" name="facebook" id="facebook" value="{{{ Input::old('facebook') }}}">
                                    @if ($errors->has('facebook')) 
                                    <div class="alert alert-danger">{{ $errors->first('facebook')  }}</div> @endif
                                </div>
                                <div class="form-group">
                                    <label for="twitter">{{{Lang::get('main.twitter')}}}</label>
                                    <input class="form-control" placeholder="{{{Lang::get('main.twitter')}}}" type="text" name="twitter" id="twitter" value="{{{ Input::old('twitter') }}}">
                                    @if ($errors->has('twitter')) 
                                    <div class="alert alert-danger">{{ $errors->first('twitter')  }}</div> @endif
                                </div>
                                <div class="form-group">
                                    <label for="fecha_nacimiento">{{{Lang::get('main.fecha_nacimiento')}}}</label>
                                    <input class="form-control" placeholder="{{{Lang::get('main.fecha_nacimiento')}}}" type="text" name="fecha_nacimiento" id="datepicker" value="{{{ Input::old('fecha_nacimiento') }}}">
                                    @if ($errors->has('fecha_nacimiento')) 
                                    <div class="alert alert-danger">{{ $errors->first('fecha_nacimiento')  }}</div> @endif
                                </div>
                                <div class="form-group">
                                    <label for="password">{{{ Lang::get('confide::confide.password') }}}</label>
                                    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
                                    @if ($errors->has('password')) 
                                    <div class="alert alert-danger">{{ $errors->first('password')  }}</div> @endif
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">{{{ Lang::get('confide::confide.password_confirmation') }}}</label>
                                    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
                                    @if ($errors->has('password_confirmation')) 
                                    <div class="alert alert-danger">{{ $errors->first('password_confirmation')  }}</div> @endif
                                </div>
                                <div class="form-group">
                                    <div id='map_canvas'></div>
                                    <input type="hidden" id="lat" name="lat" value="4.589">
                                    <input type="hidden" id="lng" name="lng" value="-73.930">
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
@section('scripts')
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript">
        var map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 6,
            center: new google.maps.LatLng(4.589 , -73.930),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var myMarker = new google.maps.Marker({
            position: new google.maps.LatLng(4.589, -73.930),
            draggable: true
        });

        google.maps.event.addListener(myMarker, 'dragend', function(evt){
            document.getElementById("lat").value = evt.latLng.lat().toFixed(3);
            document.getElementById("lng").value = evt.latLng.lng().toFixed(3);
        });

        map.setCenter(myMarker.position);
        myMarker.setMap(map);
    </script> 

    <script>
        $('#datepicker').datepicker({
            language: "es-ES",
            autoclose: true,
            todayHighlight: true
        })
    </script>    
@stop