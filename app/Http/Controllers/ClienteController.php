<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $cliente = new Cliente();
        //Para la tabla  Users
        $user->name = $request->input('nombre');
        $user->email = $request->input('usuario');
        $user->password = bcrypt($request->input('contraseña'));
        $user->save();
        //Para la tabla Clientes
        $cliente->telefono = $request->input('tel_1');
        $cliente->direccion = $request->input('direccion');
        $user->cliente()->save($cliente);
        return redirect('cliente')->with('mensaje',"Cliente agregado");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('clientes.edit',compact('cliente')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       // $user = new User();
        $cliente = Cliente::FindOrFail($id);

        $cliente->telefono = $request->input('tel_1');
        $cliente->direccion = $request->input('direccion');


        $cliente->user->name = $request->input('nombre');
        $cliente->user->password = bcrypt($request->input('contraseña'));

        $user = User::FindOrFail($cliente->user->id);
        $user->name = $request->input('nombre');
        $user->password = bcrypt($request->input('contraseña'));
        $user->save();
        $cliente->save();
/*
        //Para la tabla  Users
        $user->name = $request->input('nombre');
        $user->email = $request->input('usuario');
        $user->password = Hash::make($request->input('contraseña'));
        $user->save();
        //Para la tabla Clientes
        $cliente->telefono = $request->input('tel_1');
        $cliente->direccion = $request->input('direccion');
        $user->cliente()->save($cliente);
        */
        return redirect('cliente')->with('mensaje',"Cliente agregado");   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }


    public function lista_clientes(Request $request)
    {   
        if($request->ajax()){
            $clientes = DB::table('clientes')
                ->join('users', 'clientes.user_id', '=', 'users.id')
                ->select('clientes.id', 'users.name')
                ->take(3)
                ->get();
           // dd($clientes); die;
            return $clientes;
        }else {
            return view('clientes.index');
        }
    }   

    public function filtrar_cliente(Request $request, $cliente)
    {
        if($request->ajax()){
            //var_dump($request->route('cliente'));die;
            $cliente = str_replace(['{', '}'], '', $request->route()->parameter('cliente'));
            $clientes = DB::table('clientes')
                ->join('users', 'clientes.user_id', '=', 'users.id')
                ->select('clientes.id', 'users.name')
                ->where('users.name','LIKE','%'.$cliente.'%')
                ->limit(3)
                ->get();
           // dd($clientes); die;
            return $clientes;
        }else {
            return view('clientes.index');
        }
        
    }
}
