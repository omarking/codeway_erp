@extends('adminlte::page')

@section('title_postfix', 'Prioridad')

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
                <link class="fas fa-fw fa-columns" rel="icon">
                <a class="text-uppercase" href="{{ route('priority.index') }}">Prioridad</a>
            </h3>
        </div>
    </div>
@endsection

@section('content')
    <div>
        @livewire('priority.priority-component')
    </div>
@endsection

@section('js')
    <script>
        window.livewire.on('priorityCreatedEvent', ()=>{
            $('#createPriority').modal('hide');
        })

        window.livewire.on('priorityUpdatedEvent', ()=>{
            $('#updatePriority').modal('hide');
        })

        window.livewire.on('priorityShowEvent', ()=>{
            $('#showPriority').modal('hide');
        })

        window.livewire.on('priorityDeletedEvent', ()=>{
            $('#deletePriority').modal('hide');
        })
    </script>
@endsection
