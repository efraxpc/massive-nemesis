@extends('backend/base')
@section('scripts_header')
    {{ HTML::script('jquery.easy-confirm-dialog/jquery.easy-confirm-dialog.js') }}
    {{ HTML::script('http://code.jquery.com/ui/1.10.3/jquery-ui.js') }}
    {{ HTML::style('http://code.jquery.com/ui/1.10.3/themes/blitzer/jquery-ui.css') }}
@stop
@section('scripts')
    <script type="text/javascript">

		$( ".qrcode_imprimir" ).easyconfirm({locale: { title: 'Imprimir codigo', button: ['No','Si'] ,text: '¿Realmente desea imprimir su código?'}}).click(function() {
			
		    $.ajax({
                url:   '{{ URL::to('imprimir') }}',
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
