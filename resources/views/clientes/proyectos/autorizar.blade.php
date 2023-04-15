@extends('layouts.app')

@section('title','Autorizar-Hallazgos-Diagnósticos')

@section('content')
<input type="hidden" name="" id='myId' value="{{ $idProyecto }}">
<div id="app">
 <autorizar proyecto_id_p = "{{ $idProyecto }}" ></autorizar>
</div>



@vite('resources/js/app.js')

@endsection