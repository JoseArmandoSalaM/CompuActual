@extends('layouts.app')

@section('template_title')
    Roles
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Roles') }}
                            </span>
                        </div>
                    </div>
                    @if (session('info'))
                        <div class="alert alert-success">
                            <strong>{{ session('info') }}</strong>
                        </div>
                    @endif

                             <div class="card-body">
                                <p class="h5">Nombre</p>
                                 <p class="form-control">{{$users->name}}</p>  
                   
                                <h2 class="h5">Listado de roles</h2>
                        {!! Form::model($users,['route' => ['user.update',$users], 'method' => 'put']) !!}
                                @foreach ($roles as $role)
                                <div>
                                    <label>
                                        {!! Form::checkbox('roles[]',$role->id,null,['class' =>'mr-1']) !!}
                                        {{$role->name}}
                                    </label>
                                </div>     
                            @endforeach      
                        
                            {!! Form::submit('Asignar rol', ['class' => 'btn btn-primary mt-2']) !!}
                        {!! Form::close() !!}
                        
                                 
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection