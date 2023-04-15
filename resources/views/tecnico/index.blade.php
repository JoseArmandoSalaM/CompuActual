@extends('layouts.app')

@section('template_title')
    Home
@endsection

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 text-center mb-5">
            <h1>{{ Auth::user()->name }}</h1>
        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="row">
        <div class="col-md-6">
            
            <div class="card text-center">
            <div class="card-header">
                </div>
                <div class="card-body">
                
                    <h2 class="card-title">Nuevo proyecto</h2>
                    <a href="{{ url('/proyecto/create') }}" class="btn btn-success">Agregar</a>
                </div>
                <div class="card-footer text-muted">
                
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card text-center">
            <div class="card-header">
            </div>
                <div class="card-body">
                    <h2 class="card-title">Mis proyectos</h2>
                    <a href="{{ route('mis_proyectos') }}" class="btn btn-primary">Ver</a>
                </div>
                <div class="card-footer text-muted">
                
                </div>
            </div>
        </div>
    </div>
    

    

    
@endsection