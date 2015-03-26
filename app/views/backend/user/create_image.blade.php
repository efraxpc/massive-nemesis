@extends('backend/user/layout_create')
@section('scripts_imagem')
    @include('backend.includes.styledropzone')
@stop  
@section('content')
<div class="row-fluid">
    <div class="col-md-6 col-md-offset-3">
        <div class="position-relative">
            <div class="signup-box visible widget-box no-border">
                <div class="widget-body">
                    <div class="widget-main">

                        <div class="widget-main">
                            <div class="row">
                                 <div class="col-md-3">
                                 </div>
                                 <div class="col-md-3">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Dropzone file upload db</h3>
                                        </div>
                                        {{Form::open(array(
                                            'url'=> 'upload',
                                            'files'=>true,
                                            'class'=>'dropzone',
                                            'id'=>'my-dropzone',
                                            'method'=>'post',
                                        ))}}
                                        {{Form::close()}}
                                    </div>                                 
                                 </div>
                            </div>
                        </div>

                    </div>
                </div><!--/widget-body-->
            </div><!--/signup-box-->
        </div><!--/position-relative-->
    </div>
</div>
@stop