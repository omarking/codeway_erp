@extends('adminlte::page')

@section('title_postfix', 'Preusuario')

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
                <link class="fas fa-fw fa-user" rel="icon">
                <a class="text-uppercase" href="{{ route('preuser.index') }}">Preusuario</a>
            </h3>
        </div>
    </div>
@endsection

@section('content')
    <div>
        @livewire('preuser.preuser-component')
    </div>
@endsection

@section('js')
    <script>
        window.livewire.on('preuserCreatedEvent', ()=>{
            $('#createPreuser').modal('hide');
        })

        window.livewire.on('preuserUpdatedEvent', ()=>{
            $('#updatePreuser').modal('hide');
        })

        window.livewire.on('preuserShowEvent', ()=>{
            $('#showPreuser').modal('hide');
        })

        window.livewire.on('preuserDeletedEvent', ()=>{
            $('#deletePreuser').modal('hide');
        })
    </script>
@endsection
