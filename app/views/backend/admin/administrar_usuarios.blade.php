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
                                <th>{{{Lang::get('main.email') }}}</th>
                                <th>{{{Lang::get('main.fecha_nacimiento') }}}</th>
                                <th>{{{Lang::get('main.eps') }}}</th>
                                <th>{{{Lang::get('main.observaciones_generales') }}}</th>
                            </tr>                        
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
                                      <div class="switch">
                                        <input id="cmn-toggle_{{$user->id}}" class="cmn-toggle cmn-toggle-yes-no" type="checkbox">
                                        <label for="cmn-toggle_{{$user->id}}" data-on="SI" data-off="NO"></label>
                                      </div>
                                    </td>
                                </tr>
                            @endforeach                            
                        </table>
                    </div>
                </div>

                <!-- **********************************************************************************************************************************************************
                RIGHT SIDEBAR CONTENT
                *********************************************************************************************************************************************************** -->
            </div><! --/row -->
    </section>
</section>
@stop
@section('scripts')
    <script type="text/javascript">

        $( ".cmn-toggle" ).change(function() {
            var parametros = { 'switch_active_value' : $( this ).is(':checked') ? 1 : 0 };

// console.log(parametros);
// exit;
            $.ajax({
                    data:  parametros,
                    url:   '{{ URL::to('ajax_change_status_user') }}',
                    type:  'post',
                    success:  function (data) {
                        console.log(data.responde);

                    }
            });
        });
    </script>
@stop

