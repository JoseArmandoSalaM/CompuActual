<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;


class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
            if (auth()->user()->hasRole('Usuario')) {
                return redirect()->route('mis_proyectos');
            } elseif (auth()->user()->hasRole('Tecnico')) {
                return view('tecnico.index');
            }else {
                return view('tecnico.index');
            
        }
    }
}
