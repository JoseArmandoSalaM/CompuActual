@extends('layouts.app')

@section('title','Actualizar')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                Cleiente: {{ $cliente->user->name }}
                </div>
                <div class="card-body">
                    <form method="post" action="{{ url('/tecnicos/'.$cliente->id) }}" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }} 
                        @include('tecnicos.form',['modo'=>'Actualizar'])
                    </form>
                </div>
            </div>
            
        
        </div>
        <div class="col-md-2"></div>   
    </div>
    

    

    
@endsection