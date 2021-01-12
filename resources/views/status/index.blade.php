@extends('adminlte::page')

@section('title_postfix', 'Estado')

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
                <link class="fas fa-fw fa-tasks" rel="icon">
                <a class="text-uppercase" href="{{ route('task.index') }}">Tareas</a>
                /
                <link class="fas fa-fw fa-spinner" rel="icon">
                <a class="text-uppercase" href="{{ route('status.index') }}">Estados</a>
            </h3>
        </div>
    </div>
@endsection

@section('content')
    <div>
        @livewire('status.status-component')
    </div>
@endsection

@section('js')
    <script>
        window.livewire.on('statusCreatedEvent', ()=>{
            $('#createStatus').modal('hide');
        })

        window.livewire.on('statusUpdatedEvent', ()=>{
            $('#updateStatus').modal('hide');
        })

        window.livewire.on('statusShowEvent', ()=>{
            $('#showStatus').modal('hide');
        })

        window.livewire.on('statusDeletedEvent', ()=>{
            $('#deleteStatus').modal('hide');
        })
    </script>
@endsection
