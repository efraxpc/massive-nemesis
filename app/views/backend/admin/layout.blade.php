@extends('backend/base')
@section('header')
<header class="header black-bg">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="{{{Lang::get('main.app_name') }}}"></div>
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
                <h5 class="centered">{{$user->email}}</h5>
                <h6 class="centered">{{{Lang::get('main.admin') }}}</h6>
                <li class="mt">
                    <a class="active" id='buton_administrar_usuarios' href="{{URL::route('administrar_usuarios')}}">
                        <i class="fa fa-dashboard"></i>
                        <span >{{{Lang::get('main.administrar_usuarios') }}}</span>
                    </a>
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
        //Recuperar status (active) de usuarios
        $.each( activate_user_switch, function( key, value ) {
            if ( $( this ).attr('rol_id') == 2 ) {
                $( this ).attr('checked', true);
            }else if( $(this).attr('rol_id') == 4 ){
                $( this ).attr('checked', false);
            };
        });

        //Recuperar status de boton de habilitar/deshabiltar administrador
        jQuery.each( $('.switch_activate_admin_option'), function( i, val ) {
          var habilitar_registro_admin_option = $( this ).attr('atributo');
          if ( habilitar_registro_admin_option == 1 ) {
              $(this).attr('checked', true);
          }else if( habilitar_registro_admin_option == 4 ){
              $(this).attr('checked', false);
          };
        });
         var rol_user = 2;
         var rol_redemption = 4;
         var rol_admin = 1;
        //Recuperar status de boton de habilitar/deshabiltar status
        jQuery.each( $('.recorrer_activate_switch'), function( i, val ) {
          var role_id = $( this ).attr('role_id');
          if ( role_id == rol_user || role_id == rol_admin) {
              $(this).attr('checked', true);
          }else if( role_id == rol_redemption ){
              $(this).attr('checked', false);

          };
        });

        $( ".recorrer_activate_switch" ).change(function() {
            var parametros = { 'switch_active_value' : $( this ).is(':checked') ? 1 : 0,
                               'id_user' : $( this ).attr('id_user') };

           if($(this).parent().parent().next().children().children().is(":checked")){
               $(this).parent().parent().next().children().children().attr('checked', false);
           }

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
        //$( "#switch_active_value_url_admin" ).change(function() {
          //  var parametros = { 'switch_active_value' : $( this ).is(':checked') ? 1 : 0 };


            //if ( parametros.switch_active_value == 1 ) {
              //  $('.ocultar_direccion_administrador').show();
            //}else if( parametros.switch_active_value == 0 ){
                //ocultar direccion registrar usuario
              //  $('.ocultar_direccion_administrador').hide();
            //};
            //$.ajax({
              //      data:  parametros,
                //    url:   '{{ URL::to('ajax_permissions_create_admin') }}',
                //    type:  'post'
           // });
        //});
        //$('#test_button_works').hide();
        $( ".switch_activate_admin_option" ).click(function() {
            //check/uncheck administrador & status button
            if ( $(this).is(":checked") ) {
                if($(this).parent().parent().prev().children().children().not(":checked")){
                    $(this).parent().parent().prev().children().children().attr('checked', true);
                }
                $(this).attr('checked', true); // Checks it
            }else if( $(this).not(":checked")){
                $(this).attr('checked', false); // Checks it
            };

            var id_user = $(this).attr('id_user');
                var parametros = {'id_user':id_user,
                                  'boolean_parameter': $( this ).is(':checked') ? 1 : 0};

            $.ajax({
                   data:  parametros,
                   url:   '{{ URL::to('ajax_set_user_as_admin') }}',
                   type:  'post'
            });
        });
    </script>
@stop