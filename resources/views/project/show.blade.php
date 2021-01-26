@extends('adminlte::page')

@section('title_postfix', 'Mis Proyectos')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@endsection

@section('content_header')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <link class="fas fa-fw fa-home" rel="icon">
                <a class="text-uppercase" href="{{ route('home') }}">Codeway</a>
                /
                <link class="fas fa-fw fa-project-diagram" rel="icon">
                <a class="text-uppercase" href="{{ route('project.index') }}">Proyectos</a>
                /
                <a class="text-uppercase" href="{{ route('project.show', $project->id) }}">{{ $project->name}}</a>
            </h3>
        </div>
    </div>
@endsection

@section('content')
    <div>
        aqui estarán las tareas de este proyecto
        {{-- @livewire('project.project-component') --}}
    </div>
@endsection

@section('js')

@endsection
