<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProyectoMovilController extends Controller
{
    public function show(){

        $user = User::find(Auth::user()->id); 
       // $proyectos = $user->cliente->proyectos;

        return $user->cliente->proyectos;

        
        // response()->get([
        //     "status" => 0,
        //     "msg" => "Perfil de usuario",
        //     "data" => $proyectos,
        // ]);
    }
}
