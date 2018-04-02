@extends ('layouts.dashboard')
@section('section')
<div class="container">
  <div class="row">
    <div class="state-overview col-sm-7">
      <section class="panel">
        <div class="symbol terques">
          <i class="fa fa-group"></i>
        </div>
        <div class="value">
          <h1>Asignar</h1>
          <p>Responsables</p>
        </div>
      </section>
    </div>
    <div class="col-md-11">
      <div class="panel panel-danger">
        <div class="panel-heading"><h4>Servicio</h4></div>
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
            <form  method="POST" action="/AdminServices/public/Asignar">
              <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                  <div class="form-group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalServices">
                      Elegir servicio
                    </button>
                  </div>
              <div id="id_servicio">
                <div class="form-group">
                  <label for="txtDes">Descripcion</label>
                  <input type="hidden" class="form-control" id="idServ" name="idServ">
                  <input type="text" class="form-control" id="txtDes" name="txtDes" disabled>
                  <input type="hidden" class="form-control" id="txtDes2" name="txtDes2">
                </div>
                <div class="form-group">
                  <label for="cmbtipoasig">Comentarios</label>
                  <input type="text" class="form-control" id="txtComentarios" name="txtComentarios" disabled>
                  <input type="hidden" class="form-control" id="txtComentarios2" name="txtComentarios2">
                </div>
              </div>
              <div class="panel panel-danger">
                <div class="panel-heading"><h4>Personal que puede solicitar servicios</h4></div>
                <div class="panel-body">
                  <div class"col-md-12">
                  <div class="form-group">
                    <label for="cmbtipoasig">Asignar por:</label>
                    <select class="form-control" id="cmbtipoasig" name="cmbtipoasig">
                      <option>Empresa</option>
                      <option>Departamento</option>
                      <option>Subdepartamento</option>
                      <option>Puesto</option>
                      <option>Usuario</option>  
                    </select>
                  </div>
                  <div class="form-group" id="empresaA">
                    <label for="Empresa">Empresa:</label>
                    <select class="form-control" id="cmbEmpresaA" name="cmbEmpresaA">
                      @foreach ($datos['empresas'] as $e)
                        <option value='{{$e->name}}'>{{$e->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group" id="departamentoA">
                    <label for="cmbDepartamento">Departamento:</label>
                    <select class="form-control" id="cmbDepartamentoA" name="cmbDepartamentoA">
                      @foreach($datos['grupos_areas'] as $index=>$a)
                        <option>{{$index}}</option>
                      @endforeach
                    </select>  
                  </div>
                  <div class="form-group" id="subdepartamentoA">
                    <label for="cmbSubDepartamento">Sub-departamento:</label>
                    <select class="form-control" id="cmbSubDepartamentoA" name="cmbSubDepartamentoA">
                    </select> 
                  </div>
                  <div class="form-group" id="puestoA">
                    <label for="txtPuesto">Puesto:</label>
                    <select class="form-control" id="txtPuestoA" name="txtPuestoA">
                      @foreach ($datos['puestos'] as $p)
                        <option value='{{$p->puesto}}'>{{$p->puesto}}</option>
                      @endforeach
                    </select>  
                  </div>
                  <div id="usuarioA">
                    <div class="form-group" >
                      <label for="txtUserA">Usuario:</label>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalAsignado">
                          Agregar usuario
                        </button>
                      </div>
                      <div class="form-group">  
                        <input type="hidden" class="form-control" id="id_userA" name="id_userA">
                        <input type="text" class="form-control" id="txtUserA" name="txtUserA" disabled>
                      </div>
                  </div>
               </div> 
            </div>    
            <hr> 
            <div class="panel panel-danger">
              <div class="panel-heading"><h4>Asignar Responsable</h4></div>
              <div class="panel-body">
                <div class"col-md-12">
                  <div class="form-group">
                    <label for="cmbtipoResp">Asignar por:</label>
                    <select class="form-control" id="cmbtipoResp" name="cmbtipoResp">
                      <option>Empresa</option>
                      <option>Departamento</option>
                      <option>Subdepartamento</option>
                      <option>Puesto</option>
                      <option>Usuario</option>  
                    </select>
                  </div> 
                  <div class="form-group" id="empresaR">
                    <label for="EmpresaR">Empresa:</label>
                    <select class="form-control" id="cmbEmpresaR" name="cmbEmpresaR">
                      @foreach ($datos['empresas'] as $e)
                        <option value='{{$e->name}}'>{{$e->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group" id="departamentoR">
                    <label for="cmbDepartamentoR">Departamento:</label>
                    <select class="form-control" id="cmbDepartamentoR" name="cmbDepartamentoR">
                      @foreach($datos['grupos_areas'] as $index=>$a)
                        <option>{{$index}}</option>
                      @endforeach
                    </select> 
                  </div>
                  <div class="form-group" id="subdepartamentoR">
                    <label for="cmbSubDepartamentoR">Sub-departamento:</label>
                    <select class="form-control" id="cmbSubDepartamentoR" name="cmbSubDepartamentoR">
                    </select>
                  </div>
                  <div class="form-group" id="puestoR">
                    <select class="form-control" id="txtPuestoR" name="txtPuestoR">
                      @foreach ($datos['puestos'] as $p)
                        <option value='{{$p->puesto}}'>{{$p->puesto}}</option>
                      @endforeach
                    </select>  
                  </div>
                  <div class="form-group" id="usuarioR">
                   <div id="usuarioA">
                    <div class="form-group" >
                      <label for="txtUserRespR">Usuario:</label>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalResponsable">
                        Agregar usuario
                      </button>
                    </div>
                    <div class="form-group">  
                      <input type="hidden" class="form-control" id="id_userR"  name="id_userR">
                      <input type="text" class="form-control" id="txtUserR" name="txtUserR" disabled>
                    </div>
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
          @foreach($datos['servicios'] as $d)
            <tr id="rowService{{$d->id}}">
              <td>{{$d->id}}</td>
              <td>{{$d->tipo}}</td>
              <td>{{$d->subtipo}}</td>
              <td>{{$d->descripcion}}</td>
              <td class="text-center"><button type="button" id="{{$d->id}}" data-dismiss="modal" class="btn btn-primary">Agregar</button></td>
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
<!-- MODAL users asignado-->
<div class="modal fade" id="ModalAsignado" tabindex="-1" role="dialog" aria-labelledby="ModalAsignadoLabel" aria-hidden="true">
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
              <th>No. usuario</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Agregar</th>
            </tr>
          </thead>
          <tbody id="table_services">
          @foreach($datos['usuarios'] as $s)
            <tr id="rowService{{$s->id}}">
              <td>{{$s->id}}</td>
              <td>{{$s->first_name}}</td>
              <td>{{$s->last_name}}</td>
              <td class="text-center"><button type="button" id="A-{{$s->id}}" data-dismiss="modal" class="btn btn-primary">Agregar</button></td>
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
<!-- MODAL users responsable-->
<div class="modal fade" id="ModalResponsable" tabindex="-1" role="dialog" aria-labelledby="ModalResponsableLabel" aria-hidden="true">
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
              <th>No. Usuario</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Agregar</th>
            </tr>
          </thead>
          <tbody id="table_services">
           @foreach($datos['usuarios'] as $s)
            <tr id="rowService{{$s->id}}">
              <td>{{$s->id}}</td>
              <td>{{$s->first_name}}</td>
              <td>{{$s->last_name}}</td>
              <td class="text-center"><button type="button" id="R-{{$s->id}}" data-dismiss="modal" class="btn btn-primary">Agregar</button></td>
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
  <script src="{{ asset('js/services/asignarService.js') }}"></script>
  <script src="{{asset('js/dataTable.js')}}"></script>
  <script>
    $('#tblServicios').DataTable(); 
    $('body .dropdown-toggle').dropdown();
  </script>
@stop