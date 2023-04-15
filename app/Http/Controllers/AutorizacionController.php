<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\Proyecto;
use App\Models\Equipo;
use App\Models\DiagnosticoProyecto;
use App\Models\Respaldo;
use App\Models\Diagnostico;

use App\Models\Hallazgo;

class AutorizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($proyecto_id)
    {
        $result = DB::table('diagnosticos')
            ->join('diagnostico_proyecto', 'diagnosticos.id', '=', 'diagnostico_proyecto.diagnostico_id')
            
            ->select('diagnosticos.nombre', 'diagnosticos.costo')
            ->where('diagnostico_proyecto.proyecto_id', $proyecto_id)
            ->sum('diagnosticos.costo');
            //->get();
            //return $result;
        $proyecto = Proyecto::findOrFail($proyecto_id);
        //$diag = Diagnostico::find(4);
        //return $diag;
        $res = [
            'diagnosticos' =>  $proyecto->diagnosticos,
            'total' => $result 
        ];
        return response()->json($res, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proyecto_id = $request->proyecto_id;
        $diagnostico_id = $request->diagnostico_id;
        
        $proyecto = Proyecto::findOrFail($proyecto_id);
        $diagnostico = Diagnostico::findOrFail($diagnostico_id);
        
        //$cantidadActual = count($proyecto->diagnosticos);

        $proyecto->diagnosticos()->attach($diagnostico->id);

        //$cantidadDespues = count($proyecto->diagnosticos);
       // /if(($cantidadActual+1) == $cantidadDespues){
           // return "yes";
        //}

        return response()->json(['message' => 'Diagnostico añadido'], 200);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$proyecto = Proyecto::findOrFail($proyecto_id);
        $diagnostico = Diagnostico::findOrFail($id);
        $id_proyecto = $diagnostico->hallazgo->proyecto->id;
        $proyecto = Proyecto::findOrFail($id_proyecto);

        

        return $proyecto->diagnosticos()->detach($diagnostico->id) ;
    }
}
