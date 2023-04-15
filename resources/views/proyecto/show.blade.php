@extends('layouts.app')

@section('template_title')
    {{ $proyecto->name ?? "{{ __('Show') Proyecto" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Proyecto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('proyectos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Folio:</strong>
                            {{ $proyecto->folio }}
                        </div>
                        <div class="form-group">
                            <strong>Costofinal:</strong>
                            {{ $proyecto->CostoFinal }}
                        </div>
                        <div class="form-group">
                            <strong>Costoaprox:</strong>
                            {{ $proyecto->CostoAprox }}
                        </div>
                        <div class="form-group">
                            <strong>Fecharecibido:</strong>
                            {{ $proyecto->FechaRecibido }}
                        </div>
                        <div class="form-group">
                            <strong>Fechaentregado:</strong>
                            {{ $proyecto->FechaEntregado }}
                        </div>
                        <div class="form-group">
                            <strong>Dineroacuenta:</strong>
                            {{ $proyecto->DineroAcuenta }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
