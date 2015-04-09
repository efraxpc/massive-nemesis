@extends('backend/user/layout_create')
@section('scripts_imagem')
    @include('backend.includes.styledropzone')
@stop  
@section('sidebar')
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">

                @if ($profile_image[0]->id === null)
                    <p class="centered"><a href="{{URL::route('main')}}"> {{ HTML::image('/assets/img/avatar_perfil.png', 'a picture', array('class' => 'img-circle','width' => 150, 'height' => 130)) }}</a></p>
                @else
                    <p class="centered"><a href="{{URL::route('main')}}"> {{ HTML::image('/uploads/'. $profile_image[0]->nombre .'.'. $profile_image[0]->tipo, 'a picture', array('class' => 'img-circle','width' => 150, 'height' => 130, 'id'=>$profile_image[0]->id)) }}</a></p>
                @endif
                <h5 class="centered">{{$user->nombre_completo}}</h5>

                <li class="mt">
                    <a class="active" href="{{ URL::route('edit_user', array($id)) }}">
                        <i class="fa fa-dashboard"></i>
                        <span>{{{Lang::get('main.editar_datos_de_usuario')}}}</span>
                    </a>
                </li>
                <li class="mt">
                    <a class="active" href="{{ URL::route('edit_imagen_user', array($id)) }}">
                        <i class="fa fa-dashboard"></i>
                        <span>{{{Lang::get('main.administrar_imagenes')}}}</span>
                    </a>
                </li>      
                <li class="mt">
                    <a class="active" href="{{ URL::route('cambiar_foto_perfil') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>{{{Lang::get('main.cambiar_foto_perfil')}}}</span>
                    </a>
                </li>  
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
@stop

@section('content')

<section id="main-content">
    <section class="wrapper">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
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
                                    @if($files_asociated_table->files_aso == 0 )
                                        <a href="#myModal" class="btn btn-lg btn-primary" data-toggle="modal">{{{Lang::get('main.subir_imagenes')}}}</a>
                                    @endif
                                    
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
                                                                                            {{ Form::hidden('profile_image', 0) }}
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
                                        @for ($i = 0; $i <= count($files); $i++)
                                            <tr>
                                                <td>
                                                    @for ($i = 0; $i < count($files); $i++)
                                                        {{ HTML::image('/uploads/'. $files[$i]->nombre .'.'. $files[$i]->tipo, 'a picture', array('class' => 'img-rounded foto','width' => 150, 'height' => 130, 'id'=>$files[$i]->id)) }}
                                                    @endfor  
                                                </td>
                                            </tr>
                                        @endfor
                                    </table>
                                @endif                                
                            </div>

                        </div>
                        <div class="row-fluid">
                            <div class="col-md-12 col-md-offset-0">
                                <h5>{{{Lang::get('main.solo_podra_subir')}}} <strong>7</strong> {{{Lang::get('main.imagenes')}}}</h5>  
                            </div>
                            <div class="col-md-12 col-md-offset-0">
                                <h6>{{{Lang::get('main.para_hacer_aparecer')}}}<strong>{{{Lang::get('main.click')}}}</strong>{{{Lang::get('main.en_ella')}}}</h6>  
                            </div>
                        </div>
                    </div>

          </div>
        </div>
    </section>
</section>
@stop
@section('scripts')
    <script type="text/javascript">
    //clickamos una foto
        $( ".foto" ).easyconfirm({locale: { title: 'Borrar imagen', button: ['No','Si'] ,text: '¿Realmente desea borrar esta imagen?',}}).click(function() {
            var parametros = { 'id' : $( this ).attr('id') };
            $.ajax({
                    data:  parametros,
                    url:   '{{URL::to('ajax_remove_image')}}',
                    type:  'post',
                    beforeSend: function () {
                            $("#resultado").html("Procesando, espere por favor...");
                    },
                    success:  function (data) {
                        location.reload();
                    }
            });
        });

        Dropzone.options.myDropzone = {
            // Prevents Dropzone from uploading dropped files immediately
            autoProcessQueue : true,
            init: function() {

                this.on("success", function(file, responseText) {
                  responseText = "Imagen subida";
                  // Handle the responseText here. For example, add the text to the preview element:
                  file.previewTemplate.appendChild(document.createTextNode(responseText));
                });

                this.on('complete', function () {
                    if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                        location.reload();
                    }
                });        
            }
        };
    </script>
@stop  

