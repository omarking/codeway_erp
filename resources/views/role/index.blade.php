@extends('adminlte::page')

@section('title_postfix', 'Roles')

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
                <link class="fas fa-fw fa-thumbtack" rel="icon">
                <a class="text-uppercase" href="{{ route('role.index') }}">Roles</a>
            </h3>
        </div>
    </div>
@endsection

@section('content')
    <div>
        @livewire('role.role-component')
    </div>
@endsection

@section('js')
    <script>
        window.livewire.on('roleCreatedEvent', ()=>{
            $('#createRole').modal('hide');
        })

        window.livewire.on('roleUpdatedEvent', ()=>{
            $('#updateRole').modal('hide');
        })

        window.livewire.on('roleShowEvent', ()=>{
            $('#showRole').modal('hide');
        })

        window.livewire.on('roleDeletedEvent', ()=>{
            $('#deleteRole').modal('hide');
        })
    </script>
@endsection
