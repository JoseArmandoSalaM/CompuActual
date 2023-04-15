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
        <diagnostico proyecto_id = "{{ $proyecto->id }}"> </diagnostico>
</div>

<div class="row mt-3">
    <div class="col-md-4"></div>
    <div class="col-md-4 ">
        <form action="{{ url('proyecto/cambiarEtapa') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{  $proyecto->id }}">
            <div class="d-grid gap-2 ">
                <button class="btn btn-warning btn-lg" type="submit">Mandar a autorizar con el cliente</button>
            </div>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>


@vite('resources/js/app.js')

@endsection