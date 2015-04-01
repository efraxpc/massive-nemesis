@extends('backend/base')
@section('header')
<header class="header black-bg">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <!--logo start-->
    <a href="{{URL::route('main')}}" class="logo"><b>{{{Lang::get('main.app_name') }}}</b></a>
    <!--logo end-->
    <div class="top-menu">
        <ul class="nav pull-right top-menu">
            <li><a href="{{URL::route('logout')}}" class="logo"><b>{{{Lang::get('main.logout') }}}</b></a></li>
        </ul>
    </div>
</header>
@stop
@section('sidebar')
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">

                <p class="centered"><a href="profile.html"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
                <h5 class="centered">{{$user->nombre_completo}}</h5>

                <li class="mt">
                    <a class="active" href="{{URL::route('administrar_usuarios')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Administrar Usuarios</span>
                    </a>
                </li>
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
@stop