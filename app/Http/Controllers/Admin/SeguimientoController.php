<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Proyecto;
use App\Models\Etapas;
use App\Models\Estados;

use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$proyectos = Proyecto::find($id);
        //$et = $proyectos->etapa_id;
        //$dd = $proyectos->id;
        //$etapas= Etapas::find($et);
        //return view('seguimientos.index',array('proyectos' => $proyectos,'dd' => $dd, 'etapas' => $etapas));
        return view('seguimientos.index');
    }
    public function edit($id)
    {
        $proyectos = Proyecto::find($id);
        $et = $proyectos->etapa_id;
        $dd = $proyectos->id;
        $etapas= Etapas::find($et);
        return view('seguimientos.index',array('proyectos' => $proyectos,'dd' => $dd, 'etapas' => $etapas));

    }
    
}
