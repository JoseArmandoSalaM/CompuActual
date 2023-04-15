@extends('layouts.app')


@section('template_title')
seguimiento
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
                <imagen proyecto_id  = "{{ $proyecto->id }}" ></imagen>
            </div>

@vite('resource/js/app.js')


@endsection

