<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//Modelos
use App\Models\Proyecto;
use App\Models\Equipo;
use App\Models\User;
use App\Models\Respaldo;


class ProyectoController extends Controller
{   
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tecnico.index');
    }


    public function mis_proyectos()
    {
        $user = User::find(Auth::user()->id); //Id del trabajador 
        //$user = User::find(18); //Id del trabajador 
        //Auth::user()->id;
        $trabajador = $user->trabajador;
        if($trabajador){
            $proyectos = $trabajador->proyectos;
            //return $proyectos[0]->etapa;
        /*
        print_r($proyectos[0]->cliente->user); die; 
        $cliente = User::find($proyectos[0]->cliente->user_id);
        print_r($cliente->name); die;*/
            return view('tecnico.misProyectos', compact('proyectos'));
        }else{
            $proyectos = $user->cliente->proyectos;
            //return $proyectos;
            return view('clientes.proyectos.index', compact('proyectos'));
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('tecnico.crearProyecto');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->trabajador->id;

        $idCleinte = $request->input('idCliente');

        $proyecto = new Proyecto();
        $equipo = new Equipo();
        $respaldo = new Respaldo();

        //Proyecto
        $proyecto->folio = $request->input('folio');
        $proyecto->costo_aprox = $request->input('costoAprox');
        $proyecto->dinero_acuenta = $request->input('dineroAcuenta');
        $proyecto->fecha_recibido = date('Y-m-d');
        $proyecto->descripcion_problema = $request->input('decripcion');
        $proyecto->tipo_servicio = $request->input('tipoServicio'); 
        $proyecto->cliente_id = $request->input('idCliente');
        $proyecto->trabajador_id = Auth::user()->trabajador->id;
        $proyecto->etapa_id = 2;
        $proyecto->save();

        //Equiipo
        $equipo->nombre = $request->input('equipo');
        $equipo->caracteristicas_posibles = $request->input('caractPosibles');
        $proyecto->equipo()->save($equipo);

        if($request->input('requiereRespado') == 'si' ){
            $respaldo->ruta_carpetas = $request->input('rutas');
            $proyecto->respaldo()->save($respaldo);
        }


        return $proyecto;
        
       // $modelo = $request->input('modelo');





    }



    public function getFolio(Request $request)
    {   
        if($request->ajax()){
            $num = DB::table('proyectos')->count() + 1 ;
            $num = "" . $num;
            $lenStr = strlen($num);
            $str = "CP-" . date("m-y") . "-";
            for ($i = 0; $i < (5 - $lenStr); $i++) 
                $str .= 0;
            return $str .= $num;
        }
        
    }


    public function diagnostico()
    {
        return view('tecnico.etapa.diagnostico');
    }



    public function irEtapa(Request $request)
    {
        $idProyecto = $request->input('id');
        $proyecto = Proyecto::findOrFail($idProyecto);
        $etapa = $proyecto->etapa_id;
        switch ($etapa) {
            case 1:
                
                break;
            case 2:
                return view('tecnico.etapa.diagnostico', compact('proyecto'));
                break;
            case 3:
                return view('seguimientos.index', compact('proyecto'));
                break;
            case 4:
                return view('seguimientos.subir', compact('proyecto'));
                break;
            case 5:
                return view('seguimientos.proyectoFinalizado', compact('proyecto'));
                break;
            default:
                # code...
                break;
        }
        
        //return view('tecnico.etapa.diagnostico', compact('proyecto'));
    }
    public function clienteVerProyecto(Request $request)
    {
        $idProyecto = $request->input('id_p');
        $proyecto = Proyecto::findOrFail($idProyecto);
        return view('seguimientos.proyectoFinalizado', compact('proyecto'));
        
    }



    public function caracteristicasRealesSave(Request $request, $id)
    
    {
        //return $request->all();
        $equipo = Equipo::findOrFail($id);
        //return $equipo;
        $caracteristicas = $request->input('caracteristicas');
        $equipo->caracteristicas_reales = $caracteristicas;
        $equipo->save();
        return $equipo;
    }

    public function verCaracteristicas(Request $request, $idPryecto)
    {
        $equipo = Proyecto::findOrFail($idPryecto)->equipo;
        return $equipo;
    }

    //Controlador para mostrar la view del cliente y autorizar
    public function autorizacion(Request $request)
    {
        $idProyecto = $request->input('id');
        return view('clientes.proyectos.autorizar', compact('idProyecto'));
    }

    
    public function cambiarEtapaApi(Request $request)
    {
        $id = $request->id;
        $proyecto = Proyecto::findOrFail($id);
        $etapa = $proyecto->etapa->id;
        //var_dump($etapa) ; die;
        $nuevaEtapa = $etapa + 1;
        $proyecto->etapa_id = $nuevaEtapa;
        $proyecto->save();
        return $proyecto;
    }

    public function cambiarEtapa(Request $request)
    {
        $id = $request->id;
        $proyecto = Proyecto::findOrFail($id);
        $etapa = $proyecto->etapa->id;
        //var_dump($etapa) ; die;
        $nuevaEtapa = $etapa + 1;
        $proyecto->etapa_id = $nuevaEtapa;
        $proyecto->save();
        return redirect()->route('mis_proyectos');
    }

    public function verProyecto(Request $request)
    {
        $id = $request->id;
        $proyecto = Proyecto::findOrFail($id);
        return $proyecto;
    }

    public function verFinProyecto($id)
    {
        //$id = $request->id;
        $proyecto = Proyecto::findOrfail($id);
        $trabajador = $proyecto->trabajador->user->name;
        $cliente = $proyecto->cliente->user->name;
        $proyecto = Proyecto::findOrfail($id);
        $proyecto->hallazgos;
        $proyecto->diagnosticos;
        $proyecto->equipo;

        $costo = DB::table('diagnosticos')
            ->join('diagnostico_proyecto', 'diagnosticos.id', '=', 'diagnostico_proyecto.diagnostico_id')
            
            ->select('diagnosticos.nombre', 'diagnosticos.costo')
            ->where('diagnostico_proyecto.proyecto_id', $id)
            ->sum('diagnosticos.costo');
        
        $data = [
            'proyecto' => $proyecto,
            'trabajador' => $trabajador,
            'cliente' => $cliente,
            'costo' => $costo,
            'fecha' => date('Y-m-d')
        ];

        return $data;
    }
}

