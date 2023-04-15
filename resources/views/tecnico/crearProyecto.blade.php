@extends('layouts.app')

@section('title','Nuevo proyecto')

@section('content')
<input type="hidden" name="" id='myId' value="hola">
<div id="app">
    <form action="" method="post">
        <example-component></example-component>
    </form>
</div>



@vite('resources/js/app.js')

    
@endsection