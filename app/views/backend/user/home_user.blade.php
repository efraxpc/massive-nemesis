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
    <a href="{{URL::route('main')}}" class="logo"><b><strong>{{{Lang::get('main.app_name_title_page') }}}</strong></b></a>
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


                <!-- **********************************************************************************************************************************************************
                RIGHT SIDEBAR CONTENT
                *********************************************************************************************************************************************************** -->
                <div class="row">
                      <div class=" col-md-offset-6">
                        <p><h4>{{{ Lang::get('main.descripcion_imprimir') }}}</h4></p>
                      </div>
                    </div>  
                    
                    <div class="row mt">
                        <!-- SERVER STATUS PANELS -->
                    </div><!-- /col-lg-9 END SECTION MIDDLE -->

                    <div class="row">
                      <div class="col-md-offset-6 qrcode_imprimir">
                        {{ HTML::image($file, 'alt', array( 'width' => 420, 'height' => 420 )) }}
                      </div>
                    </div>

                    <div class="row mt">
                        <!-- SERVER STATUS PANELS -->
                    </div><!-- /col-lg-9 END SECTION MIDDLE -->

                    <div class="row">
                      <div class="col-md- col-md-offset-6">
                            <a class="active" href="{{ URL::route('mostrar', array($user->qrcode)) }}">
                                <button type="button" class="btn btn-default btn-lg">
                                  <span class="glyphicon glyphicon-globe" aria-hidden="true"></span> {{{ Lang::get('main.ver_mis_datos_publicos') }}}
                                </button>
                            </a>           
                      </div>
                    </div>          
                </div><! --/row -->

    </section>
</section>
@stop