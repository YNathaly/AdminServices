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
              <h1>Seguimiento</h1>
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
                    @if (Session::has('message'))
                      <div class="alert alert-success">
                          {{ Session::get('message') }}
                      </div>
                    @endif 
                    <form  id="service_seg" name="service_seg" method="POST" action="{{url('service_id',$datos['id'])}}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                      <div class"col-md-12">
                        <div class="form-group col-sm-5">
                          <label for="txt_fechaIni">Fecha Inicio:</label>
                          <input type="text" class="form-control" id="txt_fechaIni" name="txt_fechaIni" value="{{$datos['created_at']}}" disabled>
                        </div>  
                        <div class="form-group col-sm-2">
                        </div>
                        <div class="form-group col-sm-5">
                          <label for="txt_fechaIni">Fecha Termino:</label>
                          <input type="text" class="form-control" id="txt_fechaFin" name="txt_fechaFin" value="{{$datos['fecha_termino']}}" disabled>
                        </div>
                      </div>
                      <div class"col-md-12">
                        <div class="form-group col-sm-5">
                          <label for="txt_responsable">Responsable:</label>
                          <input type="text" class="form-control" id="txt_responsable" name="txt_responsable" value="{{$datos['responsable']}}" disabled>
                        </div>
                        <div class="form-group col-sm-2"></div>
                        <div class="form-group col-sm-5">
                          <label for="txt_solicitante">Solicitante:</label>
                          <input type="text" class="form-control" id="txt_solicitante" name="txt_solicitante" value="{{$datos['id_solicitante']}}" disabled>
                        </div>  
                      </div>  
                        <div class="form-group">
                          <label for="txtDes">Descripcion:</label>
                          <input type="text" class="form-control" id="txtDes" name="txtDes" value="{{$datos['descripcion']}}" disabled>
                        </div>
                        <div class="form-group">
                          <label for="txt_comentarios">Comentarios:</label>
                          <input type="text" class="form-control" id="txt_comentarios" name="txt_comentarios" value="{{$datos['comentarios']}}" disabled>
                        </div>
                        <div class="form-group">
                          <label for="txtCant">Cantidad:</label>
                          <input type="text" class="form-control" id="txtCant" name="txtCant" value="{{$datos['cant']}}" disabled>
                        </div>
                        <div class="form-group">
                          <label for="txtPrioridad">Prioridad:</label>
                          <input type="text" class="form-control" id="txtPrioridad" name="txtPrioridad" value="{{$datos['prioridad']}}" disabled>
                        </div>
                      <hr> 
                      <div class="panel panel-danger">
                        <div class="panel-heading"><h4>Seguimiento</h4></div>
                        <div class="panel-body">
                          <div class="form-group">
                            <label for="txt_seguimiento">Seguimiento:</label>
                            <textarea class="form-control" rows="7" id="txt_seguimiento" disabled>{{$datos['seguimiento']}}</textarea>
                          </div>
                            <div class="input-group">
                              <input type="hidden" class="form-control" id="txt_servicio" name="txt_servicio" value="{{$datos['id']}}">
                              <input type="text" class="form-control" placeholder="Escribe tu mensaje para el responsable...." id="txt_message" name="txt_message">
                              <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">Enviar</button>
                              </span>
                            </div><!-- /input-group -->

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
  <script src="{{asset('js/dataTable.js')}}"></script>
  <script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/services/seguimientoService.js') }}"></script>
  <script>
    $('body .dropdown-toggle').dropdown();
  </script>
@stop