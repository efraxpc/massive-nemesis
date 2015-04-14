@extends('backend/base')
@section('scripts_header')
    {{ HTML::script('jquery.easy-confirm-dialog/jquery.easy-confirm-dialog.js') }}
    {{ HTML::script('http://code.jquery.com/ui/1.10.3/jquery-ui.js') }}
    {{ HTML::style('http://code.jquery.com/ui/1.10.3/themes/blitzer/jquery-ui.css') }}
@stop
@section('scripts')
    <script type="text/javascript">

		$( ".qrcode_imprimir" ).easyconfirm({locale: { title: 'Imprimir codigo', button: ['No','Si'] ,text: '¿Desea imprimir su código QR?'}}).click(function() {
			
		    $.ajax({
                url:   '{{ URL::route('imprimir') }}',
                type:  'post',
                success:  function (data) {
                    //location.reload();
                }
            });
		});

        $( ".eliminar_usuario" ).easyconfirm({locale: { title: 'Borrar usuario', button: ['No','Si'] ,text: '¿Realmente desea borrar este usuario?'}}).click(function() {
            var id_user = $(this).attr('id_user');
            var parametros = {'id_user':id_user};

            $.ajax({
                    data:  parametros,
                    url:   '{{ URL::to('ajax_delete_user') }}',
                    type:  'post',
                    success:  function (data) {
                        location.reload();
                    }
            });

        });
    </script>
@stop
@section('sidebar')
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">

                @if ($profile_image[0]->id === null)
                    <p class="centered"><a href="{{URL::route('cambiar_foto_perfil')}}"> {{ HTML::image('/assets/img/avatar_perfil.png', 'a picture', array('class' => 'img-circle','width' => 150, 'height' => 130)) }}</a></p>
                @else
                    <p class="centered"><a href="{{URL::route('main')}}"> {{ HTML::image('/uploads/'. $profile_image[0]->nombre .'.'. $profile_image[0]->tipo, 'a picture', array('class' => 'img-circle','width' => 150, 'height' => 130, 'id'=>$profile_image[0]->id)) }}</a></p>
                @endif
                <h5 class="centered">{{$user->nombre_completo}}</h5>

                <li>
                    <a class="active" href="{{ URL::route('edit_user', array($id)) }}">
                        <i class="fa fa-dashboard"></i>
                        <span>{{{Lang::get('main.editar_datos_de_usuario')}}}</span>
                    </a>
                </li>
                <li>
                    <a class="active" href="{{ URL::route('edit_imagen_user', array($id)) }}">
                        <i class="fa fa-dashboard"></i>
                        <span>{{{Lang::get('main.administrar_imagenes')}}}</span>
                    </a>
                </li>      
                <li>
                    <a class="active" href="{{ URL::route('cambiar_foto_perfil') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>{{{Lang::get('main.cambiar_foto_perfil')}}}</span>
                    </a>
                </li>  
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
@stop
@section('sidebar')
    <ul class="sidebar-menu" id="nav-accordion">

        <p class="centered"><a href="profile.html"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
        <h5 class="centered">{{$user->nombre_completo}}</h5>

        <li class="mt">
            <a class="active" href="{{ URL::route('edit_user', array($id)) }}">
                <i class="fa fa-dashboard"></i>
                <span>{{{Lang::get('main.editar_datos_de_usuario')}}}</span>
            </a>
        </li>
        <li class="mt">
            <a class="active" href="{{ URL::route('edit_imagen_user', array($id)) }}">
                <i class="fa fa-dashboard"></i>
                <span>{{{Lang::get('main.administrar_imagenes')}}}</span>
            </a>
        </li>      
        <li class="mt">
            <a class="active" href="{{ URL::route('cambiar_foto_perfil', array($id)) }}">
                <i class="fa fa-dashboard"></i>
                <span>{{{Lang::get('main.cambiar_foto_perfil')}}}</span>
            </a>
        </li>  
    </ul>
@stop
            