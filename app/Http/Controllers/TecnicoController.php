<?php

namespace App\Http\Controllers;

use App\Models\Trabajadore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;


class TecnicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Trabajadore::all();
        
        return view('tecnicos.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('tecnicos.create',compact('roles'));
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
        $cliente = new Trabajadore();
        //Para la tabla  Users
        $user->name = $request->input('nombre');
        $user->email = $request->input('usuario');
        $user->password = bcrypt($request->input('contraseña'));
        
        $role = Role::findByName($request['role']);
        $user->assignRole($role);

        $user->save();
        //Para la tabla Clientes
        $cliente->telefono = $request->input('tel_1');
        $cliente->direccion = $request->input('direccion');
        $user->cliente()->save($cliente);




        return redirect('tecnicos')->with('mensaje',"Cliente agregado");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Trabajadore $cliente)
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
        $cliente = Trabajadore::findOrFail($id);
        $roles = Role::all();

        return view('tecnicos.edit',compact('cliente'),compact('roles')); 
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
        $cliente = Trabajadore::FindOrFail($id);

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
        return redirect('tecnicos')->with('mensaje',"Cliente agregado");   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trabajadore $cliente)
    {
        //
    }


}
