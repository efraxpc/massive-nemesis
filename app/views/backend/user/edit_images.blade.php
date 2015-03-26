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
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>

                        {{-- Tratamiento de imagenes --}}
                        <div class="row-fluid">
                            <div class="col-md-12 col-md-offset-0">
                            <h1>Subir imagenes</h1>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="col-md-12 col-md-offset-0">
                                <div class="bs-example">
                                    <!-- Button HTML (to Trigger Modal) -->
                                    <a href="#myModal" class="btn btn-lg btn-primary" data-toggle="modal">{{{Lang::get('main.subir_imagenes')}}}</a>
                                    
                                    <!-- Modal HTML -->
                                    <div id="myModal" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">{{{Lang::get('main.para_terminar_cerrar')}}}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-md-6 col-md-offset-3">
                                                        <div class="position-relative">
                                                            <div class="signup-box visible widget-box no-border">
                                                                <div class="widget-body">
                                                                    <div class="widget-main">

                                                                        <div class="widget-main">
                                                                            <div class="row">
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                                                 <div class="col-md-10">
                                                                                    <div class="panel panel-primary">
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
                                                <div class="modal-footer">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                             
                            </div> 
                        </div> 
                        <div class="row-fluid">
                            <div class="col-md-12 col-md-offset-0">
                                <h4>Imagenes Subidas</h4>
                                @if (count($files) != 0)
                                    <table class="table">
                                        @for ($i = 0; $i < 6; $i++)
                                            <tr>
                                                <td>
                                                    @for ($i = 0; $i < count($files); $i++)
                                                        {{ HTML::image('/uploads/'. $files[$i]->nombre .'.'. $files[$i]->tipo, 'a picture', array('class' => 'img-rounded','width' => 150, 'height' => 130)) }}
                                                    @endfor  
                                                </td>
                                            </tr>
                                        @endfor
                                    </table>
                                @endif                                
                            </div>

                        </div>
                    </div>
                </div><!--/widget-body-->
            </div><!--/signup-box-->
        </div><!--/position-relative-->
    </div>
</div>
@stop
@section('scripts')
<script type="text/javascript">
    $( "#myModal" ).click(function() {
      location.reload();
    });
    $( ".close" ).click(function() {
      location.reload();
    });
</script>

@stop