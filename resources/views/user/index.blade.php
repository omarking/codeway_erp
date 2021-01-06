@extends('adminlte::page')

@section('title_postfix', 'Usuarios')

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
                <a class="text-uppercase" href="{{ route('user.index') }}">Usuarios</a>
            </h3>
        </div>
    </div>
@endsection

@section('content')
    <div>
        @livewire('user.user-component')
    </div>
@endsection

@section('js')
    <script>
        window.livewire.on('userCreatedEvent', ()=>{
            $('#createUser').modal('hide');
        })

        window.livewire.on('userUpdatedEvent', ()=>{
            $('#updateUser').modal('hide');
        })

        window.livewire.on('userShowEvent', ()=>{
            $('#showUser').modal('hide');
        })

        window.livewire.on('userDeletedEvent', ()=>{
            $('#deleteUser').modal('hide');
        })
    </script>
@endsection
