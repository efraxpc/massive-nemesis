@extends('backend/base')

@section('content')
<table class="table table-hover">

    <tr>
        <td>
            <p>Nombre Completo</p>
            <p>{{$user->nombre_completo}}</p>
        </td>
    </tr>
    <tr>
        <td>
            <p>Grupo Sanguíneo</p>
            <p>{{$grupo_sanguineo->nombre}}</p>
        </td>
    </tr>
    <tr>
        <td>
            <p>Código Qr</p>
            <p>{{ HTML::image($qrcode.".png") }}</p>
        </td>
    </tr>
</table>
@stop
@section('scripts')
<script>
    $('#datepicker').datepicker({
        language: "es-ES",
        autoclose: true,
        todayHighlight: true
    })
</script>
@stop