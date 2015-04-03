@extends('backend/base')
@section('header')
<header class="header black-bg">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <!--logo start-->
    <a href="{{URL::route('main')}}" class="logo"><b><strong>{{{Lang::get('main.app_name_title_page') }}}</strong></b></a>
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
            <p><strong>{{{Lang::get('main.serial_marco') }}}</strong></p>
            <p>{{$user->serial_marco}}</p>
        </td>
    </tr>
    <tr>
        <td class="text-center">
            <p><strong>{{{Lang::get('main.foto_de_la_bicicleta') }}}</strong></p>
            <p>{{$user->fecha_nacimiento}}</p>
        </td>
    </tr>

    @for ($i = 0; $i < count($imagenes_de_usuario); $i++)
        @if($imagenes_de_usuario[$i])
        <tr>
            <td class="text-center">
                <p><strong>{{{Lang::get('main.foto_de_la_bicicleta') }}}</strong></p>
                {{ HTML::image('/uploads/'.$imagenes_de_usuario[$i]->nombre.'.'.$imagenes_de_usuario[$i]->tipo, 'a picture', array('class' => 'img-thumbnail','width' => 150, 'height' => 130)) }}
            </td>
        </tr>
        @endif
    @endfor     
    <tr>
        <td class="text-center">
            <p><strong>Código Qr</strong></p>
            {{ HTML::image($file) }}

        </td>
    </tr>      
</table>
@stop