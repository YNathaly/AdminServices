@extends ('layouts.dashboard')
@section('section')
<div class="container">
  <div class="row">
    <div class="state-overview col-sm-7">
      <section class="panel">
        <div class="symbol terques">
          <i class="fa fa-calculator"></i>
        </div>
        <div class="value">
          <h1>Eventos</h1>
          <p>Servicios</p>
        </div>
      </section>
    </div>
    <div class="col-md-11">
      <div class="panel panel-danger">
        <div class="panel-heading"><h4>Datos Generales</h4></div>
        <div class="panel-body">
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif
          @if ($errors->any()) 
            <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </div>
          @endif
            <div class="alert alert-success" id="alertMessage">
            </div>
          <form  id="event_service" name="event_service" method="POST" action="{{url('evento_id',$datos[0]->id_evento)}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <div class"col-md-12">
              <div class="form-group col-sm-5">
                <label for="txt_id_evento">Id evento:</label>
                <input type="text" class="form-control" id="txt_id_evento" value="{{$datos[0]->id_evento}}" name="txt_id_evento" disabled>
              </div> 
              <div class="form-group col-sm-2"></div>
              <div class="form-group col-sm-5">
                <label for="txt_fecha_evento">Fecha:</label>
                <input type="text" class="form-control" id="txt_fecha_evento" name="txt_fecha_evento" value="{{$datos[0]->fecha_evento}}"  disabled>
              </div>
            </div> 
            <div class="form-group">
              <label for="txtDes">Descripcion:</label>
              <input type="text" class="form-control" id="txtDes" name="txtDes" value="{{$datos[0]->descripcion_evento}}" disabled>
            </div>
            <div class="form-group">
              <label for="txt_comentarios">Comentarios:</label>
              <input type="text" class="form-control" id="txt_comentarios" name="txt_comentarios" value="{{$datos[0]->comentarios_evento}}" disabled>
            </div>
            <div class="col-sm-12">
              <hr>
              <div class="wizard clearfix" >
                <div class="steps clearfix">
                  <ul role="tablist" id="botones">
                  </ul>
                </div>
              </div>
              <div class="tab-content" id="tab_services">
                <!--TABS -->
                <div role="tabpanel" class="tab-pane active">
                  <div class="col-sm-12" id="divForm">
                    <div class="panel panel-info">
                    <div class="panel-heading" id="txt_titulo"></div>
                    <div class="panel-body">
                      <div class="row">
                        <div class"col-md-12">
                        <div class="form-group col-sm-5">
                          <label for="txt_fechaIni">Fecha Inicio:</label>
                          <input type="text" class="form-control" id="txt_fechaIni" name="txt_fechaIni"  disabled>
                        </div>  
                        <div class="form-group col-sm-2">
                        </div>
                        <div class="form-group col-sm-5">
                          <label for="txt_fechaIni">Fecha Termino:</label>
                          <input type="text" class="form-control" id="txt_fechaFin" name="txt_fechaFin"  disabled>
                        </div>
                      </div>
                      <div class"col-md-12">
                        <div class="form-group col-sm-5">
                          <label for="txt_responsable">Responsable:</label>
                          <input type="text" class="form-control" id="txt_responsable" name="txt_responsable"  disabled>
                        </div>
                        <div class="form-group col-sm-2"></div>
                        <div class="form-group col-sm-5">
                          <label for="txt_solicitante">Solicitante:</label>
                          <input type="text" class="form-control" id="txt_solicitante" name="txt_solicitante"  disabled>
                        </div>  
                      </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="serv_descripcion">Descripcion:</label>
                            <input type="text" class="form-control" id="serv_descripcion" name="serv_descripcion"  disabled>
                            <input type="hidden" id="serv_descripcion2" name="serv_descripcion2">
                          </div>
                          <div class="form-group">
                            <label for="serv_comentarios">Comentarios:</label>
                            <input type="text" class="form-control" id="serv_comentarios" name="serv_comentarios"  disabled>
                            <input type="hidden" class="form-control" id="serv_comentarios2" name="serv_comentarios2">
                          </div>
                          <div class="form-group">
                            <label for="serv_prioridad">Prioridad:</label>
                            <select  class="form-control" id="serv_prioridad" name="serv_prioridad" disabled>
                              <option value="Alta">Alta</option>
                              <option value="Media">Media</option>
                              <option value="Baja">Baja</option>
                            </select>  
                          </div>
                          <div class="form-group" id="divCantidad">
                            <label for="serv_cantidad">Cantidad:</label>
                            <input type="text" class="form-control" id="serv_cantidad" name="serv_cantidad" disabled>
                          </div>
                          <input type="hidden" class="form_control" id="serv_id" name="serv_id">
                          <input type="hidden" class="form-control" id= "rel_responsable" name="rel_responsable">
                          <input type="hidden" class="form-control" id= "serv_responsable" name="serv_responsable">
                          <input type="hidden" class="form-control" id= "serv_empresa" name="serv_empresa">
                          <input type="hidden" class="form-control" id= "serv_id_user" name="serv_id_user"> 
                          <div class="form-group">
                            <label for="txt_comentarios">Comentarios:</label>
                            <input type="text" class="form-control" id="txt_comentarios_gen" name="txt_comentarios_gen" disabled>
                          </div>

                          <div class="panel panel-danger">
                            <div class="panel-heading"><h4>Seguimiento</h4></div>
                            <div class="panel-body">
                              <div class="form-group">
                                <label for="txt_seguimiento">Seguimiento:</label>
                                <textarea class="form-control" rows="7" id="txt_seguimiento" disabled></textarea>
                              </div>
                                <div class="input-group">
                                  <input type="hidden" class="form-control" id="txt_servicio" name="txt_servicio">
                                  <input type="text" class="form-control" placeholder="Escribe tu mensaje para el responsable...." id="txt_message" name="txt_message">
                                  <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Enviar</button>
                                  </span>
                                </div><!-- /input-group -->

                            </div>  
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var dato ='<?php echo json_encode($datos); ?>';
</script>
@stop
@section('javascript')
  <script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/events/eventSeguimiento.js')}}"></script>
 @stop