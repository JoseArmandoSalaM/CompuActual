<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;





//Modelos
use App\Models\Proyecto;
use App\Models\Hallazgo;
use App\Models\Diagnostico;


class DiagnosticoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idHallazgo)
    {   /*
        $resultados = Hallazgo::join('diagnosticos', 'hallazgos.id', '=', 'diagnosticos.hallazgo_id')
                ->select('hallazgos.descripcion as descripcionHallazgo',
                'hallazgos.nombre',
                'hallazgos.tipo',

                'diagnosticos.*') // Seleccionar todas las columnas de ambas tablas
                ->where('hallazgos.id',$idHallazgo) 
                ->get();*/
        
        $hallazgo = Hallazgo::findOrFail($idHallazgo);
        $resultados = [
            'hallazgo' => $hallazgo,
            'diagnosticos' => $hallazgo->diagnosticos,
        ];
        return $resultados;

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
        $imagen = $request->file('foto_pieza');
        //Cambiar el nombre de la imagen 
        $nombreArchivo = "diagnostico_".date("y-m-d_H_i_s")."." . $imagen->getClientOriginalExtension();
        $rutaArchivo = $imagen->storeAs('public/diagnosticos', $nombreArchivo);
        

        $diagnostico = new Diagnostico();
        $diagnostico->nombre = $request->nombre;
        $diagnostico->hallazgo_id = $request->hallazgo_id;
        $diagnostico->foto_pieza = $nombreArchivo;
        $diagnostico->descripcion = $request->descripcion;
        $diagnostico->ponderacion = $request->ponderacion;
        $diagnostico->tiempo_instalacion = $request->tiempo_instalacion;
        $diagnostico->costo = $request->costo;
        $diagnostico->save();
                
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diaganostico  $diaganostico
     * @return \Illuminate\Http\Response
     */
    public function show(Diaganostico $diaganostico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diaganostico  $diaganostico
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $diagnostico = Diagnostico::findOrFail($id);
        return $diagnostico;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diagnostico  $diaganostico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {   
        //return $id;
        //return "efv";
        
        $imagen = $request->file('foto_pieza');
        $diagnostico = Diagnostico::findOrFail($id);
        
        if ($imagen) {
            if(Storage::delete('public/diagnosticos/'.$diagnostico->foto_pieza)){
                //Cambiar el nombre de la imagen 
                $nombreArchivo = "diagnostico_".date("y-m-d_H_i_s")."." . $imagen->getClientOriginalExtension();
                $rutaArchivo = $imagen->storeAs('public/diagnosticos', $nombreArchivo);
                $diagnostico->nombre = $request->nombre;
                $diagnostico->hallazgo_id = $request->hallazgo_id;
                $diagnostico->foto_pieza = $nombreArchivo;
                $diagnostico->descripcion = $request->descripcion;
                $diagnostico->ponderacion = $request->ponderacion;
                $diagnostico->tiempo_instalacion = $request->tiempo_instalacion;
                $diagnostico->costo = $request->costo;
                $diagnostico->save();
                //"SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'descripcion' cannot be null (SQL: update `diagnosticos` set `descripcion` = ?, `tiempo_instalacion` = ?, `ponderacion` = ?, `costo` = ?, `hallazgo_id` = ?, `diagnosticos`.`updated_at` = 2023-04-09 21:50:36 where `id` = 60)"
                return response()->json(['message' => 'Diagnóstico actualizado satisfactoriamente'], 200);
            }else{
                return response()->json(['message' => 'Ocuario un error'], 403);
            }
        }else{
            $diagnostico->hallazgo_id = $request->hallazgo_id;
            //$diaganostico->foto_pieza = $nombreArchivo;
            $diagnostico->nombre = $request->nombre;
            $diagnostico->descripcion = $request->descripcion;
            $diagnostico->ponderacion = $request->ponderacion;
            $diagnostico->tiempo_instalacion = $request->tiempo_instalacion;
            $diagnostico->costo = $request->costo;
            $diagnostico->save();
            return response()->json(['message' => 'Diagnóstico actualizado satisfactoriamente'], 200);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diaganostico  $diaganostico
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diagnostico = Diagnostico::findOrFail($id);
        if(Storage::delete('public/diagnosticos/'.$diagnostico->foto_pieza)){
            Diagnostico::destroy($id);
            return response()->json(['message' => 'Diagnóstico eliminado satisfactoriamente'], 200);
            
        }
        return response()->json(['message' => 'Ocurrio un error al eliminar el diagnóstico'], 403);
        
    }


    public function getImage( Request $request, $fileName)
    {
        $path = storage_path('app/public/diagnosticos/'. $fileName);
        if (!File::exists($path)) {
            return response()->json(['message' => 'Imagen no encontrada'], 404);
        }
    
        $file = File::get($path);
        $type = File::mimeType($path);
    
        $response = response($file, 200);
        $response->header('Content-Type', $type);
    
        return $response;
    }
}
