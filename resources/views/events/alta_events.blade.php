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
          <form  id="event_service" name="event_service" method="POST" action="{{url('eventos')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <div class"col-md-12">
              <div class="form-group col-sm-5">
                <label for="txt_id_evento">Id evento:</label>
                <input type="text" class="form-control" id="txt_id_evento" name="txt_id_evento">
              </div> 
              <div class="form-group col-sm-2"></div>
              <div class="form-group col-sm-5">
                <label for="txt_fecha_evento">Fecha:</label>
                <input type="text" class="form-control" id="txt_fecha_evento" name="txt_fecha_evento">
              </div>
            </div> 
            <div class="form-group">
              <label for="txtDes">Descripcion:</label>
              <input type="text" class="form-control" id="txtDes" name="txtDes">
            </div>
            <div class="form-group">
              <label for="txt_comentarios">Comentarios:</label>
              <input type="text" class="form-control" id="txt_comentarios" name="txt_comentarios">
            </div>
            <div class="form-group">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalServices">
                <span class="glyphicon glyphicon-search"></span> Agregar servicios
              </button>
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
                            <select  class="form-control" id="serv_prioridad" name="serv_prioridad">
                              <option value="Alta">Alta</option>
                              <option value="Media">Media</option>
                              <option value="Baja">Baja</option>
                            </select>  
                          </div>
                          <div class="form-group" id="divCantidad">
                            <label for="serv_cantidad">Cantidad:</label>
                            <input type="text" class="form-control" id="serv_cantidad" name="serv_cantidad">
                          </div>
                          <input type="hidden" class="form_control" id="serv_id" name="serv_id">
                          <input type="hidden" class="form-control" id= "rel_responsable" name="rel_responsable">
                          <input type="hidden" class="form-control" id= "serv_responsable" name="serv_responsable">
                          <input type="hidden" class="form-control" id= "serv_empresa" name="serv_empresa">
                          <input type="hidden" class="form-control" id= "serv_id_user" name="serv_id_user"> 
                          <div class="form-group">
                            <label for="txt_comentarios">Comentarios:</label>
                            <input type="text" class="form-control" id="txt_comentarios_gen" name="txt_comentarios_gen">
                          </div>
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
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
<!-- MODAL -->
<div class="modal fade" id="ModalServices" tabindex="-1" role="dialog" aria-labelledby="ModalServicesLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalServicesLabel">Seleccionar Tarea</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="tblServicios" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>No. Servicio</th>
              <th>Tipo</th>
              <th>Subtipo</th>
              <th>Descripcion</th>
              <th>Agregar</th>
            </tr>
          </thead>
          <tbody id="table_services">
          @foreach($datos as $index=>$d)
            <tr id="rowService{{$d->id}}">
              <td>{{$d->id}}</td>
              <td>{{$d->tipo}}</td>
              <td>{{$d->subtipo}}</td>
              <td>{{$d->descripcion}}</td>
              <td class="text-center"><button type="button" id="{{$index}}" data-dismiss="modal" class="btn btn-primary agregar">Agregar</button></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL -->
<script>
  var dato ='<?php echo json_encode($datos); ?>';
</script>
@stop
@section('javascript')
  <script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/events/event.js')}}"></script>
  <script src="{{asset('js/dataTable.js')}}"></script>
  <script>
    $('#tblServicios').DataTable(); 
    $('body .dropdown-toggle').dropdown();
    $('#txt_fecha_evento').datepicker();
  </script>
 @stop