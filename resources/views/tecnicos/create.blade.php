@extends('layouts.app')

@section('title','Agregar cliente')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Agregar nuevo Tecnico
                </div>
                <div class="card-body">
                    <form method="post" action="{{ url('/tecnicos') }}" enctype="multipart/form-data">
                        @csrf
                        @include('tecnicos.form',['modo'=>'Guardar'])
                    </form>
                </div>
            </div>
            
        
        </div>
        <div class="col-md-2"></div>   
    </div>
    

    

    
@endsection