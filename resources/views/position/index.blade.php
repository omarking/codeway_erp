@extends('adminlte::page')

@section('title_postfix', 'Posiciones')

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
                <link class="fas fa-fw fa-users" rel="icon">
                <a class="text-uppercase" href="{{ route('user.index') }}">Usuarios</a>
                /
                <link class="fas fa-fw fa-address-card" rel="icon">
                <a class="text-uppercase" href="{{ route('position.index') }}">Posiciones</a>
            </h3>
        </div>
    </div>
@endsection

@section('content')
    <div>
        @livewire('position.position-component')
    </div>
@endsection

@section('js')
    <script>
        window.livewire.on('positionCreatedEvent', ()=>{
            $('#createPosition').modal('hide');
        })

        window.livewire.on('positionUpdatedEvent', ()=>{
            $('#updatePosition').modal('hide');
        })

        window.livewire.on('positionShowEvent', ()=>{
            $('#showPosition').modal('hide');
        })

        window.livewire.on('positionDeletedEvent', ()=>{
            $('#deletePosition').modal('hide');
        })
    </script>
@endsection
