@extends('backend/base')
@section('scripts_header')
    {{ HTML::script('jquery.easy-confirm-dialog/jquery.easy-confirm-dialog.js') }}
    {{ HTML::script('http://code.jquery.com/ui/1.10.3/jquery-ui.js') }}

    {{ HTML::style('http://code.jquery.com/ui/1.10.3/themes/blitzer/jquery-ui.css') }}
@stop
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
Dropzone.autoDiscover = false;
    var md = new Dropzone(".mydropzone", {
        url: "/user/upload/", # your post url
        maxFilesize: "5", #max file size for upload, 5MB
        addRemoveLinks: true # Add file remove button.
    });

        md.on("complete", function (file) {
        if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
            alert('YOur action, Refresh your page here. ');
        }

        md.removeFile(file); # remove file from the zone.
    });
    </script>
@stop