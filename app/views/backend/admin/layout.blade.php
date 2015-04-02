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

                <p class="centered"><a href="profile.html"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
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
                        <input id="switch_active_value_url_admin" class="cmn-toggle cmn-toggle-yes-no " type="checkbox">
                        <label for="switch_active_value_url_admin" data-on='SI' data-off='NO'></label>
                      </div>
                    </div>
                    <span>{{{Lang::get('main.habilitar_registro_admin') }}}</span>
                </li>
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
@stop
@section('scripts')
    <script type="text/javascript">
        var obj = $('.recorrer_activate_switch');
        //Recuperar status de usuarios
        $.each( obj, function( key, value ) {
            if ( $( this ).attr('rol') == 2 ) {
                $( this ).attr('checked', true);
            }else if( $(this).attr('rol') == 4 ){
                $( this ).attr('checked', false);
            };
        });

        $( "#switch_active_value_unable_user" ).change(function() {
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
            console.log(parametros);
            

            $.ajax({
                    data:  parametros,
                    url:   '{{ URL::to('ajax_permissions_create_admin') }}',
                    type:  'post',
                    success:  function (data) {
                        console.log('te amo');

                    }
            });
        });
    </script>
@stop
