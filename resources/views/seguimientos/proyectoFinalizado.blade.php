@extends('layouts.app')

@section('template_title')
    Autorizacion
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
</div>

<div id="app">
    <fin-proyecto proyecto_id_p  = "{{ $proyecto->id }}" ></fin-proyecto>
</div>




@vite('resources/js/app.js')

@endsection