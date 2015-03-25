@extends('backend/base')
@section('header')
<header class="header black-bg">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <!--logo start-->
    <a href="index.html" class="logo"><b><strong>{{{Lang::get('main.app_name_title_page') }}}</strong></b></a>
    <!--logo end-->
</header>
@stop
@section('content')
<br>
<br>
<br>
<br>

<table class="table table-hover">

    <tr>
        <td class="text-center">
            <p><strong>Nombre Completo</strong></p>
            <p>{{$user->nombre_completo}}</p>
        </td>
    </tr>
    <tr>
        <td class="text-center">
            <p><strong>Grupo Sanguíneo</strong></p>
            <p>{{$grupo_sanguineo->nombre}}</p>
        </td>
    </tr>
    <tr>
        <td class="text-center">
            <p><strong>Facebook</strong></p>
            <p>{{$user->facebook}}</p>
        </td>
    </tr>
    <tr>
        <td class="text-center">
            <p><strong>Twitter</strong></p>
            <p>{{$user->twitter}}</p>
        </td>
    </tr>
    <tr>
        <td class="text-center">
            <p><strong>Serial del marco</strong></p>
            <p>{{$user->serial_marco}}</p>
        </td>
    </tr>
    <tr>
        <td class="text-center">
            <p><strong>Fecha de nacimiento</strong></p>
            <p>{{$user->fecha_nacimiento}}</p>
        </td>
    </tr>
    <tr>
        <td class="text-center">
            <p><strong>Código Qr</strong></p>
            <p> </p>
            {{ HTML::image('https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2F'.$qrcode.'%2F&choe=UTF-8') }}

        </td>
    </tr>
</table>
@stop
@section('scripts')
