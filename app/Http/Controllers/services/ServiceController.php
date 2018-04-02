<?php

namespace App\Http\Controllers\services;

use DB;
use App\Quotation;
use Illuminate\Http\Request;
use App\services\Services;
use App\services\Empresa;
use App\services\Areas;
use App\services\AreasGrupo;
use App\services\Grupos;
use App\services\Puestos;
use App\services\Users as User;
use App\services\Rel_services;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {   
        $services = Services::all();
        $service = array();
        foreach ($services as $s) {
            $service[$s->tipo][$s->subtipo] = $s->subtipo;
        }
        $datos = ['categorias' => $service];
        return view('services.alta_services')->with('datos',$datos);
    }


    public function show()
    {
    	$services = Services::all();
        $service = array();
        foreach ($services as $s) {
            $service[$s->tipo][$s->subtipo] = $s->subtipo;
        }
        $datos = ['categorias' => $service, 'services'=>$services];
    	return view('services.list_services')->with('datos',$datos);
    }
   
    public function store(Request $request)
	{ 
		$rules = array(
			'txt_descripcion' => 'required|min:2'
		);
		$messages = array (
			'txt_descripcion.required' => 'El campo descripcion es obligatorio',
    		'txt_descripcion.min'      => 'El minimo permitido son 2 caracteres',
		);

		$validator = Validator::make($request->all(),$rules,$messages);

		if ($validator->fails())
		{
			
			return redirect('/services')->withErrors($validator)
                        ->withInput();
		}

		Services::create(array(
			'tipo'            => $request->input('cmbTipo') == 'Nueva Categoria' ? $request->input('txt_tipo') : $request->input('cmbTipo'),
			'subtipo'         => $request->input('cmbSubtipo') == 'Nueva subCategoria' ? $request->input('txt_subtipo') : $request->input('cmbSubtipo'),
			'descripcion'     => $request->input('txt_descripcion'),
			'comentarios'     => $request->input('txt_comentarios'),
			'cantidad'        => $request->input('cmbCantidad')
		));
		return redirect('/services')->with('message','Servicio dado de alta correctamente');

	}

    public function delete(Request $request)
    {  
       $id = $request->id_service; 
       $response = array(
            'status' => 'success',
            'msg' => 'Registro eliminado correctamente',
        );

        $service = Services::find($id);
        $service->delete();
        return response()->json($response);
    } 

    public function showId(Request $request)
    {
        $id = $request->id;
        $service = Services::find($id);
        $response = array(
            'datos' => $service,
            'status'=> true,
        );
        return response()->json($response);
    } 

    public function update(Request $request) 
    {
        $id = $request->input('id_service');
        $rules = array(
            'txt_descripcion' => 'required|min:2'
        );
        $messages = array (
            'txt_descripcion.required' => 'El campo descripcion es obligatorio',
            'txt_descripcion.min'      => 'El minimo permitido son 2 caracteres',
        );

        $validator = Validator::make($request->all(),$rules,$messages);

        if ($validator->fails())
        {
            
            return redirect('/services')->withErrors($validator)
                        ->withInput();
        }

        $service = Services::find($id);

        if (count($service) >= 1) {

           $service->tipo        = $request->input('cmbTipo')    == 'Nueva Categoria' ? $request->input('txt_tipo') : $request->input('cmbTipo');
           $service->subtipo     = $request->input('cmbSubtipo') == 'Nueva subCategoria' ? $request->input('txt_subtipo') : $request->input('cmbSubtipo');
           $service->descripcion = $request->input('txt_descripcion');
           $service->comentarios =  $request->input('txt_comentarios');
           $service->cantidad    = $request->input('cmbCantidad');
           $service->save();
        }
        return redirect('/Listservices')->with('message','Servicio modificado correctamente');   
    }

    //Asignar responsables

    public function asignar()
    {   
        $empresas  = Empresa::all();
        $grupos    = Grupos::all();
        $areas     = Areas::all();
        $ag        = AreasGrupo::all();
        $puestos   = Puestos::all();
        $user      = User::all();
        $areaGrupo = array();

        foreach ($ag as $a) {

            $area      = Areas::where('id',$a->id_areas)->get();
            $grupo     = Grupos::where('id',$a->id_grupos_areas)->get();
            $servicios = Services::all();
            foreach($grupo as $g) {
                foreach($area as $a) {
                    $areaGrupo[$g->nombre][] = $a->nombre;    

                }
            }
        }
        
        $datos = ['empresas' => $empresas, 'grupos_areas' => $areaGrupo, 'puestos' => $puestos, 'servicios'=>$servicios, 'usuarios'=>$user];
        
        return view('services.asignar_services')->with('datos',$datos);
    } 

    public function storeRel(Request $request)
    {   

        $rules = array(
            'idServ' => 'required'
        );
        $messages = array (
            'idServ.required' => 'Seleccione un servicio',
        );

        switch ($request->input('cmbtipoasig')) {
            case 'Empresa':
                $solicitante = $request->input('cmbEmpresaA'); 
            break;
            case 'Departamento':
                $solicitante = $request->input('cmbDepartamentoA');
            break;
            case 'Subdepartamento':
                $solicitante = $request->input('cmbSubDepartamentoA');
            break;
            case 'Puesto':
                $solicitante = $request->input('txtPuestoA');
            break;
            case 'Usuario':
                $solicitante = $request->input('id_userA');
                $rules['id_userA'] = 'required';
                $messages['id_userA.required'] = 'Seleccione un usuario asignado';
            break;
        }
        switch ($request->input('cmbtipoResp')) {
            case 'Empresa':
                $responsable = $request->input('cmbEmpresaR');
            break;
            case 'Departamento':
                $responsable = $request->input('cmbDepartamentoR');
            break;
            case 'Subdepartamento':
                $responsable = $request->input('cmbSubDepartamentoR');
            break;
            case 'Puesto':
                $responsable = $request->input('txtPuestoR');
            break;
            case 'Usuario':
                $responsable = $request->input('id_userR');
                $asignado = $request->input('id_userA');
                $rules['id_userR'] = 'required';
                $messages['id_userR.required'] = 'Seleccione un usuario responsable';
            break;
        }

        $validator = Validator::make($request->all(),$rules,$messages);

        if ($validator->fails())
        {
            
            return redirect('/Asignar')->withErrors($validator)
                        ->withInput();
        }

        
        Rel_services::create(array(
            'id_service'      => $request->input('idServ'),
            'empresa_resp'    => $request->input('cmbEmpresaR'),
            'tipo_rel_resp'   => $request->input('cmbtipoResp'),
            'responsable'     => $responsable,
            'empresa_sol'     => $request->input('cmbEmpresaA'),
            'tipo_rel_sol'    => $request->input('cmbtipoasig'),
            'solicitante'     => $solicitante
        ));
        return redirect('/Asignar')->with('message','Servicio dado de alta correctamente');

    }

    public function showRel(Request $request)
    {
        $services = DB::table('services')
            ->select('services.descripcion','services.tipo','services.subtipo','rel_services_resp.id_service','rel_services_resp.empresa_resp','rel_services_resp.tipo_rel_resp','rel_services_resp.responsable','rel_services_resp.tipo_rel_sol','rel_services_resp.solicitante','rel_services_resp.id' )
            ->join('rel_services_resp', 'rel_services_resp.id_service', '=', 'services.id')
            ->get();
        
        $datos = ['services' => $services];
        return view('services.list_relserv')->with('datos',$datos);
    }

    public function deleteRel(Request $request)
    {
       $id = $request->id_rel; 
       $response = array(
            'status' => 'success',
            'msg' => 'Registro eliminado correctamente',
        );

        $rel = Rel_services::find($id);
        $rel->delete();
        return response()->json($response); 
    }
        
      
}
