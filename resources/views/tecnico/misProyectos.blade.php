@extends('layouts.app')

@section('title','Mis-proyectos')

@section('content')
    <div class="row">
        <div class="col-md-1"></div>
        
        <div class="col-md-10">

        <table class="table">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Folio</th>
                <th scope="col">Cliente</th>
                <th scope="col">Etapa</th>
                <th scope="col">Seguimiento</th>
                </tr>
            </thead>
            <tbody>
            @foreach($proyectos as $proyecto)
                <tr>
                <th scope="row">{{$proyecto->id}}</th>
                <td>{{$proyecto->folio}}</td>
                <td>{{$proyecto->cliente->user->name}}</td>
                <td>{{$proyecto->etapa->Nombre}}</td>
                <td>
                    <form action="{{ url('proyecto/etapa') }}" method="post">
                    @csrf
                        <input type="hidden" name="id" value="{{  $proyecto->id }}">
                        <button type="submit" class="btn btn-primary">Seguir</button>
                    </form>
                </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    
        </div>

        <div class="col-md-1"></div>
    </div>

@endsection