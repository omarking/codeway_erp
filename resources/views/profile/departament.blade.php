@extends('adminlte::page')

@section('title_postfix', 'Mi Departamento')

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
                <link class="fas fa-fw fa-house-user" rel="icon">
                <a class="text-uppercase" href="{{ route('mydepartament') }}">Mi Departamento</a>
            </h3>
        </div>
    </div>
@endsection

@section('content')
    <div>
        @livewire('profile.mydepartament-component')
    </div>
@endsection

@section('js')

@endsection
