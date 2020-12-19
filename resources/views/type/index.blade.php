{{-- Extendemos de la plantilla Admin LTE --}}
@extends('adminlte::page')

{{-- Le asignamos en sufijo al titlo de la pagina --}}
@section('title_postfix', 'Type')

{{-- Asi podemos hacer uso de un plugin, en este caso Sweet Alert 2 --}}
@section('plugins.Datatables', true)

{{-- En esta seccion va algun estilo CSS que queramos agregar --}}
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/css/admin_custom.css">
@endsection

{{-- Este es la seccion del header en el body de la plantilla Admin LTE --}}
@section('content_header')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><a href="{{ route('home') }}">Codeway</a>/<a href="{{ route('type.index') }}">Tipos</a></h3>
        </div>
    </div>
@endsection
{{-- Aquí va todo el contenido que queramos mostrar --}}
@section('content')
    <div>
        @livewire('type-component')
    </div>
@stop

@section('js')
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

    <script>
        $('#typeTable').DataTable({
            responsive: true,
            autoWidth: false,

            "language": {
                "lengthMenu": "Mostrar " +
                                `<select class="custom-slect custom-select-sm form-control form-control-sm">
                                    <option value='10'>10</option>
                                    <option value='25'>25</option>
                                    <option value='50'>50</option>
                                    <option value='100'>100</option>
                                    <option value='-1'>Todos</option>
                                </select>`
                                            + " registros por página",
                "zeroRecords": "Ningun registro coincide con la busqueda",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay resultados disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search" : "Buscar :",
                "paginate" : {
                    "next" : "Siguiente",
                    "previous" : "Anterior",
                }
            }
        });
    </script>
@stop


{{-- Es la imagen que mostrara cuando aún no termine de cargar completamente la pagina --}}
{{-- <img src="{{ asset('favicons/android-icon-192x192.png') }}" alt="CODEWAY"> --}}
