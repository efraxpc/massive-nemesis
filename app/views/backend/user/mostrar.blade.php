@extends('backend/base')
@section('header')
<header class="header black-bg">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="{{{Lang::get('main.app_name_title_page') }}}"></div>
    </div>
    <!--logo start-->
    @if($id_validation === null)
        <a href="#" class="logo"><b><strong>{{{Lang::get('main.app_name_title_page') }}}</strong></b></a>
    @else
        <a href="{{URL::route('main')}}" class="logo"><b><strong>{{{Lang::get('main.app_name_title_page') }}}</strong></b></a>
    @endif

    <!--logo end-->
</header>
@stop
@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-9 main-chart">
                <div class="row mt"> </div><!-- /col-lg-9 END SECTION MIDDLE -->

                <table class="table table-hover">

                    <tr>
                        <td class="text-center">
                            <p><strong>{{{Lang::get('main.nombre_completo') }}}</strong></p>
                            <p>{{$user->nombre_completo}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <p><strong>{{{Lang::get('main.grupo_sanguineo') }}}</strong></p>
                            <p>{{$grupo_sanguineo}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <p><strong>{{{Lang::get('main.eps') }}}</strong></p>
                            <p>{{$user->eps}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <p><strong>{{{Lang::get('main.emergencia') }}}</strong></p>
                            <p>{{$user->emergencia}}</p>
                        </td>
                    </tr>                    
                    <tr>
                        <td class="text-center">
                            <p><strong>{{{Lang::get('main.facebook') }}}</strong></p>
                            <p>{{$user->facebook}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <p><strong>{{{Lang::get('main.twitter') }}}</strong></p>
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
                            <p><strong>{{{Lang::get('main.fecha_nacimiento') }}}</strong></p>
                            <p>{{ date("d/m/Y",strtotime($user->fecha_nacimiento)) }}</p>
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
                            <p><strong>{{{Lang::get('main.codigo_qr') }}}</strong></p>
                            {{ HTML::image($file) }}

                        </td>
                    </tr>      
                </table>
                
            </div>
    </section>
</section>

@stop