<?php

namespace App\Http\Controllers;

use App\Models\Reparacion;
use App\Models\Proyecto;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
/**
 * Class ReparacionController
 * @package App\Http\Controllers
 */
class ReparacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dd = 1; 
        return view('seguimientos.subir')->with('dd',$dd);
        //return view('seguimientos.subir');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $datos = $request->input('valor');
        

    
        foreach ($request->all() as $key => $file) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $filename = "reparacion_".date("y-m-d_H_i_s")."." . $file->getClientOriginalExtension();
                //$filename = $file->getClientOriginalName();
                $rutaArchivo = $file->storeAs('public/reparaciones', $filename);

                $ruta = new Reparacion();
                $ruta->image = $filename;
                $ruta->proyecto_id = $datos;
                //$file->move(public_path('img'), $filename);
                $ruta->save();
             
                return response()->json(['message' => 'Imágenes guardadas correctamente']);
            } 
        }

    
   
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dd = $id; 
        return view('seguimientos.subir')->with('dd',$dd);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Reparacion $reparacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reparacion $reparacion)
    {
       
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
      
    }


    public function reparaciones($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return $proyecto->reparaciones;
    }

    public function getImage( Request $request, $fileName)
    {
        $path = storage_path('app/public/reparaciones/'. $fileName);
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
