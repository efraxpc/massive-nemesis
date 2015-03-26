@extends('backend/user/layout_create')
@section('scripts_imagem')
    @include('backend.includes.styledropzone')
@stop  
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
                        <form method="POST" action="{{{ URL::to('usuario/pipo2') }}}" accept-charset="UTF-8">
                            <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
                            <input type="hidden" name="tipo" value="user">
                            <input type="hidden" name="editar" value="true">
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <fieldset>
                                @if (Cache::remember('username_in_confide', 5, function() {
                                    return Schema::hasColumn(Config::get('auth.table'), 'username');
                                }))
                                <div class="form-group">
                                    <label for="username">{{{ Lang::get('confide::confide.username') }}}</label>
                                    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.username') }}}" type="text" name="username" id="username" value="{{{ Input::old('username') }}}">
                                    @if ($errors->has('username')) 
                                    <div class="alert alert-danger">{{ $errors->first('username')  }}</div> @endif
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="email">{{{ Lang::get('confide::confide.e_mail') }}} <small>{{ Lang::get('confide::confide.signup.confirmation_required') }}</small></label>
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

                        <div class="bs-example">
                            <!-- Button HTML (to Trigger Modal) -->
                            <a href="#myModal" class="btn btn-lg btn-primary" data-toggle="modal">{{{Lang::get('main.subir_imagenes')}}}</a>
                            
                            <!-- Modal HTML -->
                            <div id="myModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">{{{Lang::get('main.para_terminar_cerrar')}}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-6 col-md-offset-3">
                                                <div class="position-relative">
                                                    <div class="signup-box visible widget-box no-border">
                                                        <div class="widget-body">
                                                            <div class="widget-main">

                                                                <div class="widget-main">
                                                                    <div class="row">
                                                <br/>
                                                <br/>
                                                <br/>
                                                                         <div class="col-md-10">
                                                                            <div class="panel panel-primary">
                                                                                {{Form::open(array(
                                                                                    'url'=> 'upload',
                                                                                    'files'=>true,
                                                                                    'class'=>'dropzone',
                                                                                    'id'=>'my-dropzone',
                                                                                    'method'=>'post',
                                                                                ))}}
                                                                                {{Form::close()}}
                                                                            </div>                                 
                                                                         </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div><!--/widget-body-->
                                                    </div><!--/signup-box-->
                                                </div><!--/position-relative-->
                                            </div>
                                        </div>
                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 

                        @for ($i = 0; $i < count($files); $i++)
                            {{ HTML::image('/uploads/'. $files[$i]->nombre .'.'. $files[$i]->tipo, 'a picture', array('class' => 'img-rounded','width' => 150, 'height' => 130)) }}
                        @endfor

                    </div>
                </div><!--/widget-body-->
            </div><!--/signup-box-->
        </div><!--/position-relative-->
    </div>
</div>
@stop