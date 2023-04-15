@extends('layouts.app')

@section('template_title')
    Proyecto
@endsection

@section('content')
    <div class="row">
        
        <div class="col-md-12">
            <div class="table-responsive">
            <table class="table table-striped text-center">
                    <thead>
                      <tr>
                        <th scope="col">Folio</th>
                        <th >Etapa</th>
                        <th >Ver</th>
                        <th >Autorizar</th>
                        
                        
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($proyectos as $proyecto)
                      <tr>
                        
                        <td>{{$proyecto->folio}}</td>
                        
                        <td>{{$proyecto->etapa->Nombre}}</td>
                        <td>
                            <button class="btn btn-secondary">
                            <i class="fa fa-eye" aria-hidden="true"></i>   
                            </button>
                            &nbsp;
                            
                        </td>
                        <td>
                            <form action="{{ url('/cliente/autorizar') }}"  method="post">
                            @csrf
                                <input type="hidden" name="id" value="{{  $proyecto->id }}">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-check-circle" aria-hidden="true"></i> 
                                </button>
                            </form>
                       
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                            
            </div>
    </div>

@endsection