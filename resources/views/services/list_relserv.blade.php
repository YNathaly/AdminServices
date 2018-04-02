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
            <h1>Listado de responsables</h1>
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
                    <table id="tbl_servicesRel" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>tipo</th>
                                <th>subtipo</th>
                                <th>Descripcion</th>
                                <th>tipo solicitante</th>
                                <th>Solicitante</th>
                                <th>tipo responsable</th>
                                <th>Responsable</th>
                                <th>Eliminar</th>
                                
                            </tr>
                        </thead>
                        <tbody id="tbl_servicesRel">
                            @foreach ($datos['services'] as $e)
                              <tr id="serv{{$e->id}}">
                                <td>{{$e->tipo}}</td>
                                <td>{{$e->subtipo}}</td>
                                <td>{{$e->descripcion}}</td>
                                <td>{{$e->tipo_rel_sol}}</td>
                                <td>{{$e->solicitante}}</td>
                                <td>{{$e->tipo_rel_resp}}</td>
                                <td>{{$e->responsable}}</td>
                                <td class="text-center"><a  class="btn btn-link text-danger btn-xs eliminarServ"  id="{{$e->id}}" title="Eliminar Responsable"><span class="fa fa-close fa-2x"></span></a></td>
                              </tr>  
                            @endforeach
                        </tbody>
                    </table>
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
    
    <script src="{{asset('js/dataTable.js')}}"></script>
    <script src="{{asset('js/services/listAsignarService.js')}}"></script>
    <script>
        $('#tbl_servicesRel').DataTable(); 
        $('body .dropdown-toggle').dropdown();
    </script>
  
@stop