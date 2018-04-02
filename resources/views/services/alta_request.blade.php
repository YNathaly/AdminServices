@extends ('layouts.dashboard')
@section('section')
<div class="container">
  <div class="row">
    <div class="state-overview col-sm-7">
        <section class="panel">
          <div class="symbol terques">
            <i class="fa fa-list-ol"></i>
          </div>
          <div class="value">
            <h1>Solicitud</h1>
            <p>Servicios</p>
          </div>
        </section>
      </div>
    <div class="col-md-11">
      <div class="panel panel-danger">
        <div class="panel-heading">Alta servicios</div>
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
          @if (Session::has('message'))
            <div class="alert alert-success">
              {{ Session::get('message') }}
            </div>
          @endif 
          <form  method="POST" action="/AdminServices/public/solicitarServicio">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                <div class="form-group">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Elegir servicio
                  </button>
                </div>
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
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- MODAL -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Seleccionar Tarea</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="tblServicios" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Tipo</th>
              <th>Subtipo</th>
              <th>Descripcion</th>
              <th>Agregar</th>
            </tr>
          </thead>
          <tbody id="table_services">
            @foreach($datos as $d)
              <tr>
                <td>{{$d->tipo}}</td>
                <td>{{$d->subtipo}}</td>
                <td>{{$d->descripcion}}</td>
                <td class="text-center"><button type="button" id="Add_{{$d->id}}" data-dismiss="modal" class="btn btn-primary">Agregar</button></td>
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
</div>

<script>
  var dato ='<?php echo json_encode($datos); ?>';
</script>
@stop
@section('javascript')
  <script src="{{asset('js/dataTable.js')}}"></script>
  <script src="{{ asset('js/services/services.js') }}"></script>
  <script>
    $('#tblServicios').DataTable(); 
    $('body .dropdown-toggle').dropdown();
  </script>
@stop
