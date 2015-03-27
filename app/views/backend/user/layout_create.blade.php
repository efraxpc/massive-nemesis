@extends('backend/base')
@section('header')
<header class="header black-bg">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <!--logo start-->
    <a href="index.html" class="logo"><b>{{{Lang::get('main.app_name') }}}</b></a>
    <!--logo end-->
    <div class="top-menu">
        <ul class="nav pull-right top-menu">
            <li><a class="logout" href="login.html">Logout</a></li>
        </ul>
    </div>
</header>
@stop
@section('scripts')
    <script>
        $('#datepicker').datepicker({
            language: "es-ES",
            autoclose: true,
            todayHighlight: true
        })
    </script>

    <script type="text/javascript">
        Dropzone.options.myDropzone={
            AutoProcessQueue : true,
            addRemoveLinks: true
        };
    </script>
@stop