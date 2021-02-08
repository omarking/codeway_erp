@extends('adminlte::page')

@section('title_postfix', 'Home')

@section('content_header')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <link class="fas fa-fw fa-home" rel="icon">
                <a class="text-uppercase" href="{{ route('home') }}">Dashboard</a>
            </h3>
        </div>
    </div>
@stop


@section('content')

    <div>
        @livewire('user.events-component')

        @livewire('profile.miprojects-component')
    </div>

@stop


@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">

@stop


@section('js')

@stop
