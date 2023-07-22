@extends('layouts.app')


@section('template_title')
Cliente
@endsection

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            
        <div class="card">
            <div class="card-header">
                <a href="{{ url('/tecnicos/create') }}" class = "btn btn-success">Nuevo Tecnico</a>
            </div>
            <div class="card-body">
                <h5 class="card-title">Tenicos</h5>

                <table class="table table-striped text-center">
                    <thead >
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $cliente)
                            <tr>
                                <th scope="row">{{ $cliente->id }}</th>
                                <td>{{ $cliente->user->name }}</td>
                                <td>{{ $cliente->telefono }}</td>
                                <td>{{ $cliente->direccion }}</td>
                                <td>
                                    <a href="{{ url('/tecnicos/'.$cliente->id.'/edit') }}" class="btn btn-primary">
                                        Editar
                                    </a> 
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>




        </div>
        <div class="col-md-2"></div>   
    </div>
    

    

    
@endsection