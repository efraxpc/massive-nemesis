@extends('backend/admin/layout')
@section('content')
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
    
                {{-- BOTTOM SPACE --}}
                <div class="row mt">
                    <!-- SERVER STATUS PANELS -->
                </div><!-- /col-lg-9 END SECTION MIDDLE -->

        <div class="row ocultar_direccion_administrador">
          <div class="col-md-3 col-md-offset-3"><p>{{{Lang::get('main.texto_enlace_crear_admin')}}}</p></div>
          <div class="col-md-6 col-md-offset-3"><pre><code class='codigo'>{{{Lang::get('main.codigo_registrar_usuario')}}}</code></pre></div>
        </div>      
    </section>
</section>

@stop
