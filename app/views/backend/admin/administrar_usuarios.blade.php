@extends('backend/admin/layout')
@section('content')
<!--main content start-->
<section id="main-content">
    <section class="wrapper">

        <div class="row">
            <div class="col-lg-9 main-chart">

                <div class="row">
                    <div class="col-md-12">

                        <table class='table'>
                            <tr>
                                <th>{{{Lang::get('main.nombre_completo') }}}</th>
                                <th>{{{Lang::get('main.mail') }}}</th>
                                <th>{{{Lang::get('main.fecha_nacimiento') }}}</th>
                                <th>{{{Lang::get('main.eps') }}}</th>
                                <th>{{{Lang::get('main.observaciones_generales') }}}</th>
                                <th>{{{Lang::get('main.status_usuario') }}}</th>
                            </tr>    
                            {{--*/ $i = 0 /*--}}  
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        {{$user->nombre_completo}}
                                    </td>
                                    <td>
                                        {{$user->email}}
                                    </td>
                                    <td>
                                        {{$user->fecha_nacimiento}}
                                    </td>
                                    <td>
                                        {{$user->eps}}
                                    </td>
                                    <td>
                                        {{$user->observaciones_generales}}
                                    </td>  
                                    <td>
                                    @if($user_id != $user->id)
                                        <div class="switch">
                                            <input id="cmn-toggle_{{$user->id}}" class="cmn-toggle cmn-toggle-yes-no recorrer_activate_switch" id_user = '{{$user->id}}' type="checkbox" counter={{$i}} rol='{{ $assigned_roles[$i]->role_id }}'>
                                            <label for="cmn-toggle_{{$user->id}}" data-on="ACTIVO" data-off="INACTIVO"></label>
                                          </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger eliminar_usuario" id_user = '{{$user->id}}'>{{{ Lang::get('main.eliminar') }}}</button>
                                        </td>
                                    @endif
                                </tr>
                                {{--*/ $i++ /*--}}    
                            @endforeach                            
                        </table>
                    </div>
                </div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

            </div><! --/row -->
    </section>
</section>
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

        $( ".cmn-toggle" ).change(function() {
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

        $( ".eliminar_usuario" ).easyconfirm({locale: { title: 'Borrar usuario', button: ['No','Si'] ,text: '¿Realmente desea borrar este usuario?',}}).click(function() {
            var id_user = $(this).attr('id_user');
            var parametros = {'id_user':id_user};
            console.log(id_user);

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

