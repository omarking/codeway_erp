{{-- Extendemos de la plantilla Admin LTE --}}
@extends('adminlte::page')
{{-- Le asignamos en sufijo al titlo de la pagina --}}
@section('title_postfix', 'Home')
{{-- Este es la seccion del header en el body de la plantilla Admin LTE --}}
@section('content_header')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <link class="fas fa-fw fa-home" rel="icon">
                <a class="text-uppercase" href="{{ route('home') }}">Codeway</a>
            </h3>
        </div>
    </div>
@stop
{{-- Aquí va todo el contenido que queramos mostrar --}}
@section('content')

    <div>
        @livewire('profile.miprojects-component')
    </div>

@stop

{{-- En esta seccion va algun estilo CSS que queramos agregar --}}
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
{{-- Aqui va un script JS que queramos agregar como un script de un plugin --}}
@section('js')
    <script>

    </script>
@stop

{{-- Es la imagen que mostrara cuando aún no termine de cargar completamente la pagina --}}
{{-- <img src="{{ asset('favicons/android-icon-192x192.png') }}" alt="CODEWAY"> --}}
