@extends('backend/user/layout_panel_user')
@section('scripts_imagem')
    @include('backend.includes.styledropzone')
@stop  
@section('content')
<!--main content start-->
<section id="main-content">
    <section class="wrapper">

        <div class="row">
            <div class="col-lg-9 main-chart">

                <div class="row">
                    <div class="col-xs-6 col-md-3">
                        <a href="#" class="thumbnail">
                            <img src="..." alt="...">
                        </a>
                    </div>
                    ...
                </div>
                <div class="row mt">
                    <!-- SERVER STATUS PANELS -->
                </div><!-- /col-lg-9 END SECTION MIDDLE -->

                <h2>home user</h2>
                <p>Generar Codigo Qr</p>

                <a class="active" href="{{ URL::to('usuario/mostrar', array($user->qrcode)) }}">
                                        <i class="fa fa-dashboard"></i>
                                        <span>Ver mis datos públicos</span>
                                    </a>

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
                <h5 class="centered">Marcel Newman</h5>

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
