<?php

namespace App\Http\Controllers;

use App\Models\Hallazgo;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class HallazgoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $hallazgo = Proyecto::findOrFail($id);
        return $hallazgo->hallazgos;
        
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
        $hallazgo = new Hallazgo();
        $hallazgo->nombre  = $request->input('nombre');
        $hallazgo->descripcion  = $request->input('descripcion');
        $hallazgo->tipo  = $request->input('tipo');
        $hallazgo->proyecto_id  = $request->input('idProyecto');
        $hallazgo->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hallazgo  $hallazgo
     * @return \Illuminate\Http\Response
     */
    public function show(Hallazgo $hallazgo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hallazgo  $hallazgo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $hallazgo = Hallazgo::findOrFail($id);
        
        return $hallazgo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hallazgo  $hallazgo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hallazgo = Hallazgo::findOrFail($id);
        $hallazgo->nombre = $request->input('nombre');
        $hallazgo->tipo = $request->input('tipo');
        $hallazgo->descripcion = $request->input('descripcion');
        $hallazgo->save();

        return $hallazgo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hallazgo  $hallazgo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Hallazgo::destroy($id);
    }
}
