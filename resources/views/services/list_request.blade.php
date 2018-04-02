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
            <h1>Listado de Servicios</h1>
            <p>Servicios</p>
          </div>
        </section>
      </div>
        <div class="col-md-11">
            <div class="panel panel-danger">
                <div class="panel-heading"><h4>Servicios</h4></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table id="tbl_services" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No. Servicio</th>
                                <th>Descripcion</th>
                                <th>Comentarios</th>
                                <th>Responsable</th>
                                <th>Ver seguimiento</th>
                                
                            </tr>
                        </thead>
                        <tbody id="table_services">
                            @foreach ($datos['services'] as $e)
                                <tr id="serviceRow{{$e->id}}">
                                    <td> {{$e->id}} </td>
                                    <td> {{$e->descripcion}} </td>
                                    <td> {{$e->comentarios}} </td>
                                    <td>  <b>{{$e->rel_responsable}} :</b>{{$e->responsable}} </td>
                                    <td class="text-center"><a  class="btn btn-link btn-xs actualizar"  title="Seguimiento" href="{{url('service_id',$e->id)}}" id="{{$e->id}}"><span class="fa fa-file-o fa-2x"></span></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                   
                   
                </div>
            </div>
        </div>
    </div>
</div>
  <!-- MODAL -->
<div class="modal fade" id="modal_services" tabindex="-1" role="dialog" aria-labelledby="modal_servicesLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="contError">  
          @if ($errors->any()) 
            <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </div>
          @endif
        </div>
        <form id="edit_service" method="POST" action="/AdminServices/public/updateservices">
          <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
          <input type="hidden" name="id_service" id="id_service"></input>
          <div class="form-group">
            <label for="txt_descripcion">Descripcion:</label>
            <input type="text" class="form-control" id="txt_descripcion" name="txt_descripcion">
          </div>
          <div class="form-group">
            <label for="cmbCantidad">Cantidad:</label>
            <select class="form-control" id="cmbCantidad" name="cmbCantidad">
              <option value='No'>No</option>
              <option value='Si'>Si</option>  
            </select>  
          </div>
          <div class="form-group">
            <label for="txt_comentarios">Comentarios:</label>
            <input type="text" class="form-control" id="txt_comentarios" name="txt_comentarios">
          </div>
          <hr> 
          <div class="panel panel-danger">
            <div class="panel-heading"><h4>Categorizar Servicio</h4></div>
              <div class="panel-body">
                <div class"col-md-12">  
                  <div class="form-group col-sm-6">
                    <label for="txt_tipo">Tipo:</label>
                    <select class="form-control" id="cmbTipo" name="cmbTipo">
                    </select>
                    <div id="categoria"> 
                      <hr>
                      <label for="txt_tipo">Captura Nueva Categoria:</label>
                      <input type="text" class="form-control" id="txt_tipo" name="txt_tipo">
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="txt_tipo">Subtipo:</label>
                    <select class="form-control" id="cmbSubtipo" name="cmbSubtipo">
                    </select>
                    <div id="subcategoria"> 
                      <hr>
                      <label for="txt_tipo">Captura Nueva SubCategoria:</label>
                      <input type="text" class="form-control" id="txt_subtipo" name="txt_subtipo">
                    </div> 
                  </div>
                </div>
              </div>  
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>  
          </form>
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
    
    <script src="{{asset('js/dataTable.js')}}"></script>
    <script src="{{ asset('js/services/listServices.js')}}"></script>
    <script>
        $('#tbl_services').DataTable(); 
        $('body .dropdown-toggle').dropdown();
    </script>
  
@stop