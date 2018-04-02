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
              <h1>Alta de Servicios</h1>
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
                    <form  method="POST" action="/AdminServices/public/services">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
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
  <script src="{{ asset('js/services/service.js') }}"></script>
@stop