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
                                             <th>{{{Lang::get('main.administador') }}}</th>
                                             <th>{{{Lang::get('main.perfil_publico') }}}</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         @foreach($users_list as $key => $usuario)
                                            @if($usuario->email <> $string_mail_admin_root && $usuario->id <> $user_id)
                                                 <tr>
                                                     <td>
                                                         {{$usuario->nombre_completo}}
                                                     </td>
                                                     <td>
                                                         {{$usuario->email}}
                                                     </td>
                                                     <td>
                                                         {{ date("d/m/Y",strtotime($usuario->fecha_nacimiento)) }}
                                                     </td>
                                                     <td>
                                                         {{$usuario->eps}}
                                                     </td>
                                                     <td>
                                                         {{$usuario->observaciones_generales}}
                                                     </td>
                                                     <td align="center">
                                                         <div class="switch">
                                                             <input id="switch_active_value_unable_user_{{$usuario->id}}" class="cmn-toggle cmn-toggle-yes-no recorrer_activate_switch" id_user = '{{$usuario->id}}' type="checkbox" counter={{$key}} rol='{{ $assigned_roles[$key]->role_id }}' role_id='{{$active_status_from_users[$key]->role_id}}'>
                                                             <label for="switch_active_value_unable_user_{{$usuario->id}}" data-on="{{{Lang::get('main.activo_mayus') }}}" data-off="{{{Lang::get('main.inactivo_mayus') }}}"></label>
                                                         </div>
                                                     </td>
                                                     <td align="center">
                                                         <div class="switch">
                                                             <input id="switch_activate_admin_option_{{$usuario->id}}" id_user = '{{$user->id}}' class="cmn-toggle cmn-toggle-yes-no switch_activate_admin_option" type="checkbox" atributo ='{{ $admin_status_from_users[$key]->role_id }}' >
                                                             <label for="switch_activate_admin_option_{{$usuario->id}}" data-on="{{{Lang::get('main.si_mayus') }}}" data-off="{{{Lang::get('main.no_mayus') }}}"></label>
                                                         </div>
                                                     </td>
                                                     <td align="center">
                                                        <a href="{{URL::route('mostrar',$usuario->qrcode)}}"><button type="button" class="btn btn-info">{{{ Lang::get('main.ver') }}}</button></a>
                                                     </td>
                                                     <td align="center">
                                                         <button type="button" class="btn btn-danger eliminar_usuario" id_user = '{{$usuario->id}}'>{{{ Lang::get('main.eliminar') }}}</button>
                                                     </td>
                                                 </tr>
                                            @endif
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
