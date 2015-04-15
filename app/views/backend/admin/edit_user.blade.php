@extends('backend/admin/layout')
@section('scripts_imagem')
    @include('backend.includes.styledropzone')
@stop
@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="row mt"></div>
            <div class="row mt"></div>
               <p>{{{Lang::get('main.modificar_datos')}}}</p>
               <form method="POST" action="{{{ URL::route('admin_editar_usuario') }}}" accept-charset="UTF-8">
                    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
                    <input type="hidden" name="tipo" value="user">
                    <input type="hidden" name="habilitar_registro_admin_option_edit" class="habilitar_registro_admin_option_edit" atributo="{{$habilitar_registro_admin_option}}">
                    <input type="hidden" name="editar" value="true">
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <input type="hidden" name="admin" value= true">

                    <fieldset>
                        <div class="form-group">
                            <label for="username">{{{Lang::get('main.nombre_completo')}}}</label>
                            <input class="form-control" placeholder="{{{Lang::get('main.nombre_completo')}}}" type="text" name="nombre_completo" id="nombre_completo"value="{{$user->nombre_completo}}">
                            @if ($errors->has('nombre_completo'))
                            <div class="alert alert-danger">{{ $errors->first('nombre_completo')  }}</div> @endif
                        </div>
                        <div class="form-group">
                            <label for="email">{{{ Lang::get('confide::confide.e_mail') }}}</label>
                            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{$user->email}}">
                            @if ($errors->has('email'))
                            <div class="alert alert-danger">{{ $errors->first('email')  }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::select('grupo_sanguineo_id', $tipo_de_sangre ,Input::old('grupo_sanguineo_id'),array('class'=>'form-control')) }}
                            @if ($errors->has('tipo_de_sangre'))
                            <div class="alert alert-danger">{{ $errors->first('tipo_de_sangre')  }}</div> @endif
                        </div>
                        <div class="form-group">
                            <label for="eps">{{{Lang::get('main.eps')}}}</label>
                            <input class="form-control" placeholder="{{{Lang::get('main.eps')}}}" type="text" name="eps" id="eps" value="{{$user->eps}}">
                            @if ($errors->has('eps'))
                            <div class="alert alert-danger">{{ $errors->first('eps')  }}</div> @endif
                        </div>
                        <div class="form-group">
                            <label for="persona_emergencia">{{{Lang::get('main.persona_emergencia_nombre')}}}</label>
                            <input class="form-control" placeholder="{{{Lang::get('main.ingrese_nombre_emergencia')}}}" type="text" name="persona_emergencia" id="persona_emergencia" value="{{$user->persona_emergencia}}">
                            @if ($errors->has('persona_emergencia'))
                            <div class="alert alert-danger">{{ $errors->first('persona_emergencia')  }}</div> @endif
                        </div>
                        <div class="form-group">
                            <label for="emergencia">{{{Lang::get('main.emergencia')}}}</label>
                            <input class="form-control" placeholder="{{{Lang::get('main.ingrese_numero')}}}" type="text" name="emergencia" id="emergencia" value="{{$user->emergencia}}">
                            @if ($errors->has('emergencia'))
                            <div class="alert alert-danger">{{ $errors->first('emergencia')  }}</div> @endif
                        </div>
                        <div class="form-group">
                            {{{Lang::get('main.observaciones_generales') }}}
                            <br>
                            {{ Form::textarea('observaciones_generales', $user->observaciones_generales, ['class' => 'form-control', 'placeholder' => "Observaciones Generales"]) }}
                            @if ($errors->has('observaciones_generales'))
                            <div class="alert alert-danger">{{ $errors->first('observaciones_generales')  }}</div> @endif
                        </div>
                        <div class="form-group">
                            <label for="serial_marco">{{{Lang::get('main.serial_marco')}}}</label>
                            <input class="form-control" placeholder="{{{Lang::get('main.serial_marco')}}}" type="text" name="serial_marco" id="serial_marco" value="{{$user->serial_marco}}">
                            @if ($errors->has('serial_marco'))
                            <div class="alert alert-danger">{{ $errors->first('serial_marco')  }}</div> @endif
                        </div>
                        <div class="form-group">
                            <label for="facebook">{{{Lang::get('main.facebook')}}}</label>
                            <input class="form-control" placeholder="{{{Lang::get('main.facebook')}}}" type="text" name="facebook" id="facebook" value="{{$user->facebook}}">
                            @if ($errors->has('facebook'))
                            <div class="alert alert-danger">{{ $errors->first('facebook')  }}</div> @endif
                        </div>
                        <div class="form-group">
                            <label for="twitter">{{{Lang::get('main.twitter')}}}</label>
                            <input class="form-control" placeholder="{{{Lang::get('main.twitter')}}}" type="text" name="twitter" id="twitter" value="{{$user->twitter}}">
                            @if ($errors->has('twitter'))
                            <div class="alert alert-danger">{{ $errors->first('twitter')  }}</div> @endif
                        </div>
                        <div class="form-group">
                            <label for="fecha_nacimiento">{{{Lang::get('main.fecha_nacimiento')}}}</label>
                            <input class="form-control" placeholder="{{{Lang::get('main.fecha_nacimiento')}}}" type="text" name="fecha_nacimiento" id="datepicker" value="{{ date("d/m/Y",strtotime($user->fecha_nacimiento)) }}">
                            @if ($errors->has('fecha_nacimiento'))
                            <div class="alert alert-danger">{{$errors->first('fecha_nacimiento')}}</div> @endif
                        </div>
                        <div class="form-group">
                            <div id='map_canvas'></div>
                            <input type="hidden" id="lat" name="lat" value="{{$user->lat}}">
                            <input type="hidden" id="lng" name="lng" value="{{$user->lng}}">
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
                          <button type="submit" class="btn btn-primary">{{Lang::get('main.guardar_cambios')}}</button>
                        </div>
                    </fieldset>
                </form>
          </div>
        </div>
    </section>
</section>

@stop
@section('scripts')
    <script type="text/javascript">
        //Recuperar status de permisos de registro de usuarios
        var habilitar_registro_admin_option = $('.habilitar_registro_admin_option_edit').attr('atributo');

        if ( habilitar_registro_admin_option == 1 ) {
            $('#switch_active_value_url_admin').attr('checked', true);
            $('.ocultar_direccion_administrador').show();
        }else if( habilitar_registro_admin_option == 0 ){
            $('#switch_active_value_url_admin').attr('checked', false);
            //ocultar direccion registrar usuario
            $('.ocultar_direccion_administrador').hide();
        };
        //Script de cambio de opcion para habilitar o deshabilitar regitro de admins
        $( "#switch_active_value_url_admin" ).change(function() {
            var parametros = { 'switch_active_value' : $( this ).is(':checked') ? 1 : 0 };

            if ( parametros.switch_active_value == 1 ) {
                $('.ocultar_direccion_administrador').show();
            }else if( parametros.switch_active_value == 0 ){
                //ocultar direccion registrar usuario
                $('.ocultar_direccion_administrador').hide();
            };
            $.ajax({
                    data:  parametros,
                    url:   '{{ URL::to('ajax_permissions_create_admin') }}',
                    type:  'post'
            });
        });
    </script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript">
        var map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 6,
            center: new google.maps.LatLng(document.getElementById("lat").value , document.getElementById("lng").value),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var myMarker = new google.maps.Marker({
            position: new google.maps.LatLng(document.getElementById("lat").value, document.getElementById("lng").value),
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