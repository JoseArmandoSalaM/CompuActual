@extends('layouts.app')


@section('template_title')
seguimiento
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div style="display: flex; justify-content: center; align-items: center;">
<div id="app">
<script>
    window.valor_recibido = "{{ $dd }}";
</script>
    <imagen></imagen>
</div>
</div>
</div>
</div>

@vite('resource/js/app.js')


@endsection