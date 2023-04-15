@extends('layouts.app')


@section('template_title')
Seguimiento
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div style="display: flex; justify-content: center; align-items: center;">
        <div id="app2">
                <progress-vue progress="{{ $proyecto->etapa->Porcentaje }}" current="{{ $proyecto->etapa->id  }}"></progress-vue>
                <h3 style="display: flex; justify-content: center; align-items: center; margin: 15px;"> Etapa: !! {{$proyecto->etapa->Nombre}} !! </h3>
            </div>
        </div>
        </div>
        <div class="order-status">
            <h1 style="display: flex; justify-content: center; align-items: center;">Modulo 4. Autorización</h1>
            <div id="app">
                <auto :valor="2"></auto>
                <div style="display: flex; justify-content: center; align-items: center; margin: 15px;">
                    <a class="btn btn-danger" href="{{ route( 'mis_proyectos' ) }}"> {{ __('Cerrar X') }}</a>
                    
                </div>
            </div>
            </strong>
        </div>

        @vite('resource/js/app.js')
    </div>
</div>
@endsection