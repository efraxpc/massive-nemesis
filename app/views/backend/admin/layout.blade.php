@extends('backend/base')
@section('header')
<header class="header black-bg">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <!--logo start-->
    <a href="{{URL::route('main')}}" class="logo"><b>{{{Lang::get('main.app_name') }}}</b></a>
    <!--logo end-->
    <div class="top-menu">
        <ul class="nav pull-right top-menu">
            <li><a href="{{URL::route('logout')}}" class="logo"><b>{{{Lang::get('main.logout') }}}</b></a></li>
        </ul>
    </div>
</header>
@stop

@section('scripts_header')
    {{ HTML::script('jquery.easy-confirm-dialog/jquery.easy-confirm-dialog.js') }}
    {{ HTML::script('http://code.jquery.com/ui/1.10.3/jquery-ui.js') }}
    {{ HTML::style('http://code.jquery.com/ui/1.10.3/themes/blitzer/jquery-ui.css') }}
@stop
@section('sidebar')
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">

                <p class="centered"><a href="{{URL::route('main')}}"> {{ HTML::image('/assets/img/avatar_perfil.png', 'a picture', array('class' => 'img-circle','width' => 150, 'height' => 130)) }}</a></p>
                <h5 class="centered">{{$user->nombre_completo}}</h5>

                <li class="mt">
                    <a class="active" href="{{URL::route('administrar_usuarios')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>{{{Lang::get('main.administrar_usuarios') }}}</span>
                    </a>
                </li>
                <li class="mt">
                    <div class="col-md-6 col-md-offset-3">
                      <div class="switch">
                        <input id="switch_active_value_url_admin" class="cmn-toggle cmn-toggle-yes-no habilitar_registro_admin_option" type="checkbox" atributo ='{{$habilitar_registro_admin_option}}'>
                        <label for="switch_active_value_url_admin" data-on='SI' data-off='NO'></label>
                      </div>
                    </div>
                    <p align="center"><b>{{{Lang::get('main.habilitar_registro_admin') }}}</b></p>
                </li>
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
@stop
@section('scripts')
    <script type="text/javascript">
        var activate_user_switch = $('.recorrer_activate_switch');
        //Recuperar status de usuarios
        $.each( activate_user_switch, function( key, value ) {
            if ( $( this ).attr('rol') == 2 ) {
                $( this ).attr('checked', true);
            }else if( $(this).attr('rol') == 4 ){
                $( this ).attr('checked', false);
            };
        });

        //Recuperar status de permisos de registro de usuarios
        var habilitar_registro_admin_option = $('.habilitar_registro_admin_option').attr('atributo');

        if ( habilitar_registro_admin_option == 1 ) {
            $('#switch_active_value_url_admin').attr('checked', true);
            $('.ocultar_direccion_administrador').show();
        }else if( habilitar_registro_admin_option == 0 ){
            $('#switch_active_value_url_admin').attr('checked', false);
            //ocultar direccion registrar usuario
            $('.ocultar_direccion_administrador').hide();
        };        

        $( ".recorrer_activate_switch" ).change(function() {
            var parametros = { 'switch_active_value' : $( this ).is(':checked') ? 1 : 0,
                               'id_user' : $( this ).attr('id_user') };

            $.ajax({
                    data:  parametros,
                    url:   '{{ URL::to('ajax_change_status_user') }}',
                    type:  'post',
                    success:  function (data) {
                        console.log(data.responde);

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
@stop