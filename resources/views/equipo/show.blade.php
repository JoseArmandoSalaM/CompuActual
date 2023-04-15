@extends('layouts.app')

@section('template_title')
    {{ $equipo->name ?? "{{ __('Show') Equipo" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Equipo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('equipos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombreequipo:</strong>
                            {{ $equipo->NombreEquipo }}
                        </div>
                        <div class="form-group">
                            <strong>Caracteristicasreales:</strong>
                            {{ $equipo->CaracteristicasReales }}
                        </div>
                        <div class="form-group">
                            <strong>Caracteristicasposibles:</strong>
                            {{ $equipo->CaracteristicasPosibles }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
