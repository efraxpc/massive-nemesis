@extends('backend/admin/layout')
@section('content')

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
		  	<div class="row mt">
              <div class="col-lg-12">
                      <div class="content-panel">
						  <h4><i class='fa fa-angle-right'></i>{{{Lang::get('main.lista_de_usuarios') }}}</h4>
                          <section id="no-more-tables">
                                 <table class='table table-bordered table-striped table-condensed cf'>
                                     <thead class="cf">
                                         <tr>
                                             <th>{{{Lang::get('main.nombre_completo') }}}</th>
                                             <th>{{{Lang::get('main.mail') }}}</th>
                                             <th>{{{Lang::get('main.fecha_nacimiento') }}}</th>
                                             <th>{{{Lang::get('main.eps') }}}</th>
                                             <th>{{{Lang::get('main.observaciones_generales') }}}</th>
                                             <th>{{{Lang::get('main.status_usuario') }}}</th>
                                         </tr>
                                     </thead>
                                         {{--*/ $i = 0 /*--}}
                                         @foreach ($users as $user)
                                     <tbody>
                                             <tr>
                                                 @if( $user->role_auxilar <> 'admin' )
                                                     <td>
                                                         {{$user->nombre_completo}}
                                                     </td>

                                                     <td>
                                                         {{$user->email}}
                                                     </td>
                                                     <td>
                                                         {{$user->fecha_nacimiento}}
                                                     </td>
                                                     <td>
                                                         {{$user->eps}}
                                                     </td>
                                                     <td>
                                                         {{$user->observaciones_generales}}
                                                     </td>
                                                     <td>
                                                         <div class="switch">
                                                             <input id="switch_active_value_unable_user_{{$user->id}}" class="cmn-toggle cmn-toggle-yes-no recorrer_activate_switch" id_user = '{{$user->id}}' type="checkbox" counter={{$i}} rol='{{ $assigned_roles[$i]->role_id }}'>
                                                             <label for="switch_active_value_unable_user_{{$user->id}}" data-on="{{{Lang::get('main.activo_mayus') }}}" data-off="{{{Lang::get('main.inactivo_mayus') }}}"></label>
                                                         </div>
                                                     </td>
                                                     <td>
                                                         <button type="button" class="btn btn-danger eliminar_usuario" id_user = '{{$user->id}}'>{{{ Lang::get('main.eliminar') }}}</button>
                                                     </td>
                                                 @endif
                                             </tr>
                                             {{--*/ $i++ /*--}}
                                         @endforeach
                                     </tbody>
                                 </table>
                          </section>
                      </div><!-- /content-panel -->
                  </div><!-- /col-lg-12 -->
              </div><!-- /row -->

		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

  </section>
@stop
