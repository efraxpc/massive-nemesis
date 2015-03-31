@extends('backend/user/layout_panel_user')
@section('scripts_imagem')
    @include('backend.includes.styledropzone')
@stop  
@section('header')
<header class="header black-bg">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <!--logo start-->
    <a href="{{ URL::route('main') }}" class="logo"><b>{{{Lang::get('main.app_name') }}}</b></a>
    <!--logo end-->

    <div class="top-menu">
        <ul class="nav pull-right top-menu">
            <li><a href="{{URL::route('logout')}}" class="logo"><b>{{{Lang::get('main.logout') }}}</b></a></li>
        </ul>
    </div>
</header>
@stop

@section('content')
<!--main content start-->
<section id="main-content">
    <section class="wrapper">

        <div class="row">
            <div class="col-lg-9 main-chart">
                <div class="row mt">
                    <!-- SERVER STATUS PANELS -->
                </div><!-- /col-lg-9 END SECTION MIDDLE -->

                <h2>home user</h2>
                <p>Generar Codigo Qr</p>
                {{$id}}

                <a class="active" href="{{ URL::to('usuario/mostrar', array($user->qrcode)) }}">
                                        <i class="fa fa-dashboard"></i>
                                        <span>Ver mis datos públicos</span>
                                    </a>
<h4>sera!!</h4> 
                <!-- **********************************************************************************************************************************************************
                RIGHT SIDEBAR CONTENT
                *********************************************************************************************************************************************************** -->
            </div><! --/row -->
    </section>
</section>
@stop
@section('sidebar')
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">

                <p class="centered"><a href="profile.html"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
                <h5 class="centered">{{$user->nombre_completo}}</h5>

                <li class="mt">
                    <a class="active" href="{{ URL::to('usuario/editar', array($id)) }}">
                        <i class="fa fa-dashboard"></i>
                        <span>{{{Lang::get('main.editar_datos_de_usuario')}}}</span>
                    </a>
                </li>
                <li class="mt">
                    <a class="active" href="{{ URL::to('usuario/editar/imagen', array($id)) }}">
                        <i class="fa fa-dashboard"></i>
                        <span>{{{Lang::get('main.administrar_imagenes')}}}</span>
                    </a>
                </li>                
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
@stop
