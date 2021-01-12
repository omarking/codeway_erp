@extends('adminlte::page')

@section('title_postfix', 'Periodos')

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
                <link class="fas fa-fw fa-plane-departure" rel="icon">
                <a class="text-uppercase" href="{{ route('holiday.index') }}">Vacaciones</a>
                /
                <link class="fas fa-fw fa-thumbtack" rel="icon">
                <a class="text-uppercase" href="{{ route('period.index') }}">Periodos</a>
            </h3>
        </div>
    </div>
@endsection

@section('content')
    <div>
        @livewire('period.period-component')
    </div>
@endsection

@section('js')
    <script>
        window.livewire.on('periodCreatedEvent', ()=>{
            $('#createPeriod').modal('hide');
        })

        window.livewire.on('periodUpdatedEvent', ()=>{
            $('#updatePeriod').modal('hide');
        })

        window.livewire.on('periodShowEvent', ()=>{
            $('#showPeriod').modal('hide');
        })

        window.livewire.on('periodDeletedEvent', ()=>{
            $('#deletePeriod').modal('hide');
        })
    </script>
@endsection
