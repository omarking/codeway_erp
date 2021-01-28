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
                <img width="3%" class="img-circule" src="{{ asset('storage/projects/' . $project->avatar) }}" alt="{{ $project->avatar }}">
                <a class="text-uppercase" href="{{ route('project.show', $project->id) }}">{{ $project->name}}</a>
            </h3>
        </div>
    </div>
@endsection

@section('content')

    <div>
        @livewire('profile.mytask-component', ['project' => $project])
    </div>

@endsection

@section('js')
    {{-- <script>
        $('body_scroll').scrollspy({ target: '#navbar-example' })
    </script> --}}
    <script>
        window.livewire.on('taskCreatedEvent', ()=>{
            $('#createTask').modal('hide');
        })

        window.livewire.on('taskUpdatedEvent', ()=>{
            $('#updateTask').modal('hide');
        })

        /* window.livewire.on('projectShowEvent', ()=>{
            $('#showProject').modal('hide');
        })

        window.livewire.on('projectDeletedEvent', ()=>{
            $('#deleteProject').modal('hide');
        }) */
    </script>
@endsection
