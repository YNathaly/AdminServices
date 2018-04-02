<?php

namespace App\Http\Controllers\services;

use DB;
use App\Quotation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\services\Services;
use App\services\ServiceUser;
use App\services\Users;
use App\Http\Controllers\services\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $services = DB::table('services')
            ->select('services.descripcion','services.comentarios','services.tipo','services.subtipo','services.cantidad','rel_services_resp.id_service','rel_services_resp.tipo_rel_resp','rel_services_resp.responsable','rel_services_resp.tipo_rel_sol','rel_services_resp.solicitante','rel_services_resp.id', 'rel_services_resp.empresa_sol' )
            ->join('rel_services_resp', 'rel_services_resp.id_service', '=', 'services.id')
            ->get();
        $service = array();
        foreach ($services as $index=>$s) {

            if ( $s->tipo_rel_resp == 'Usuario') {

                $user = Users::find($s->responsable);
                $s->responsable = $s->responsable .'|'.$user->first_name.' '.$user->last_name;    
            } 

            if ($s->tipo_rel_sol == 'Empresa' && $s->solicitante == $user['attributes']['company']) {
                $service[] = $s;
            } else if ($s->tipo_rel_sol == 'Departamento' && $s->solicitante == $user['attributes']['division'] &&  $s->empresa_sol == $user['attributes']['company']) {
                $service[] = $s;
            } else if ($s->tipo_rel_sol == 'Subdepartamento' && $s->solicitante == $user['attributes']['subdivision'] &&  $s->empresa_sol == $user['attributes']['company']) {
                $service[] = $s;
            } else if ($s->tipo_rel_sol == 'Puesto' && $s->solicitante == $user['attributes']['workstation'] &&  $s->empresa_sol == $user['attributes']['company']) {
                $service[] = $s;
            } else if ($s->tipo_rel_sol == 'Usuario' && $s->solicitante == $user['attributes']['id'] &&  $s->empresa_sol == $user['attributes']['company']) {
                $service[] = $s;
            } 
        }
        return view('services.alta_request')->with('datos',$service);
    }

    public function show()
    {   
        $user = Auth::user();

        $services = ServiceUser::where('id_solicitante',$user['attributes']['id'])->get();
        foreach($services as $index=>$value) {
            if($value->rel_responsable == "Usuario") {

                $user = Users::find($value->responsable);
                $value->responsable = $value->responsable .'|'.$user->first_name.' '.$user->last_name;
            }
        }
    	$datos = ['services' => $services];

    	return view('services.list_Request')->with('datos',$datos);
    }
   
    public function store(Request $request)
	{   
        $user = Auth::user();

        $rules = array(
			'serv_descripcion2' => 'required|min:2'
		);
		$messages = array (
			'serv_descripcion2.required' => 'No ha seleccionado un servicio',
    		'serv_descripcion2.min'      => 'No ha seleccionado un servicio',
		);

		$validator = Validator::make($request->all(),$rules,$messages);

		if ($validator->fails())
		{
			
			return redirect('/solicitarServicio')->withErrors($validator)
                        ->withInput();
		}

		ServiceUser::create(array(
			'id_solicitante'     => $user['attributes']['id'],
			'id_servicio'        => $request->input('serv_id'),
			'descripcion'        => $request->input('serv_descripcion2'),
			'cant'               => $request->input('serv_cantidad'),
			'empresa_resp' 		 => $request->input('serv_empresa'),
			'rel_responsable'    => $request->input('rel_responsable'),
			'responsable'        => $request->input('serv_responsable'),
			'prioridad'          => $request->input('serv_prioridad'),
            'id_evento'          => 'NA',
            'comentarios'        => $request->input('txt_comentarios_gen'),
			));
		return redirect('/solicitarServicio')->with('message','Servicio dado de alta correctamente');

	}

    public function show_id($id)
    {
        
        $service = ServiceUser::find($id);

        if($service->rel_responsable == "Usuario") {

            $user = Users::find($service->responsable);
            $service->responsable = $service->responsable .'|'.$user->first_name.' '.$user->last_name;
        }
        $userS = Users::find($service->id_solicitante);
        $service->id_solicitante = $service->id_solicitante.'|'.$userS->first_name.' '.$userS->last_name;
        return view('services.service')->with('datos',$service);
    }

    public function storeSeguimiento(Request $request)
    {   
        $rules = array(
            'txt_message' => 'required'
        );
        $messages = array (
            'txt_message.required' => 'No ha capturado su mensaje',
        );

        $validator = Validator::make($request->all(),$rules,$messages);

        if ($validator->fails())
        {
            
            $response = array(
                'status' => 'false',
                'msg' => "No ha capturado su mensaje",
            );
            return response()->json($response);
        }

        $user = Auth::user();
        $hoy = date("F j, Y, g:i a")."-";
        $valueAfter = $hoy.$user['attributes']['first_name'].' '.$user['attributes']['last_name'].' >> ';
        $service = ServiceUser::find($request->input('txt_servicio'));
        $val = $service->seguimiento.'\n'.$valueAfter.$request->input('txt_message');
        $service->seguimiento = $val;
        $service->save();

        $response = array(
            'status' => 'success',
            'msg' => $val,
        );
        return response()->json($response);
    }
}
