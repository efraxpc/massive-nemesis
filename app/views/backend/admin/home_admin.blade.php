@extends('backend/admin/layout')
@section('content')
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        {{-- BOTTOM SPACE --}}
        <div class="row mt">
          <div class="col-lg-12">
            @if($user->super_admin <> 1)
              <div class="row ocultar_direccion_administrador">
                <div class="col-md-3 col-md-offset-3"><p>{{{Lang::get('main.texto_descriptivo_super_admin')}}}</p></div>
                <div class="col-md-6 col-md-offset-3"><pre><code class='codigo'>{{{Lang::get('main.texto_cuenta_admin')}}}</code></pre></div>
              </div>
            @endif
          </div>
        </div><!-- /col-lg-9 END SECTION MIDDLE -->
    </section>
</section>
@stop
