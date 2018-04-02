<?php

namespace App\Http\Controllers\events;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\services\Services;
use App\services\ServiceUser;
use App\Http\Controllers\Controller;
use App\services\Users;
use Illuminate\Support\Facades\Validator;

class EventsController extends Controller
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
            ->select('services.descripcion','services.comentarios','services.tipo','services.subtipo','services.cantidad','rel_services_resp.id_service','rel_services_resp.empresa_resp','rel_services_resp.tipo_rel_resp','rel_services_resp.responsable','rel_services_resp.tipo_rel_sol','rel_services_resp.solicitante','rel_services_resp.id', 'rel_services_resp.empresa_sol' )
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

        return view('events.alta_events')->with('datos',$service);
    }

    public function show()
    {   
        $user = Auth::user();
    	$services =ServiceUser::where('id_solicitante',$user['attributes']['id'])->whereNotIn('id_evento',['NA'])->groupBy("id_evento")->get();
    	$datos = ['services' => $services];
    	return view('events.list_events')->with('datos',$datos);
    }
   
    public function store(Request $request)
    {   
        $user = Auth::user();
        $max = DB::select(DB::raw("select max(`id_evento`) as evento from list_users_services where id_evento NOT IN('NA')"));


        if ($max[0]->evento) {
           $id_evento = $max[0]->evento+1;
        }else{
            $id_evento = 1;
        }

        foreach($request->datos as $index=>$value) {
           ServiceUser::create(array(
            'id_solicitante'     => $user['attributes']['id'],
            'id_servicio'        => $value['id_service'],
            'descripcion'        => $value['descripcion'],
            'cant'               => $value['cant'],
            'empresa_resp'       => $value['empresa_resp'],
            'rel_responsable'    => $value['tipo_rel_resp'],
            'responsable'        => $value['responsable'],
            'prioridad'          => $value['prioridad'],
            'id_evento'          => $id_evento,
            'fecha_evento'       => $request->fecha_evento,
            'descripcion_evento' => $request->descripcion_evento,
            'comentarios_evento' => $request->comentarios_evento,
            'solicito_evento'    => $user['attributes']['id'],
            'comentarios'        => $value['comentarios'],
            )); 
        }

        
        $response = array(
            'status' => 'success',
            'msg' => 'Evento dado de alta correctamente',
        );
        return response()->json($response);

    }

    public function show_id($id) 
    {   
        $services = ServiceUser::where('id_evento',$id)->get();
        foreach( $services as $index=>$service) {
            if($service->rel_responsable == "Usuario") {

                $user = Users::find($service->responsable);
                $services[$index]->responsable = $service->responsable .'|'.$user->first_name.' '.$user->last_name;
            }
            $userS = Users::find($service->id_solicitante);
            $services[$index]->id_solicitante = $service->id_solicitante.'|'.$userS->first_name.' '.$userS->last_name;
            $services[$index]->seguimiento = preg_replace("[\n|\r|\n\r]", '\n', $services[$index]->seguimiento);
        }
         
        return view('events.event')->with('datos',$services);
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
        $val = $service->seguimiento." \n ".$valueAfter.$request->input('txt_message');
        $service->seguimiento = $val;
        $service->save();
        $response = array(
            'status' => 'success',
            'msg' => $val,
        );
        return response()->json($response);
    }

}
