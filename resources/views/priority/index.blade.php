{{-- Extendemos de la plantilla Admin LTE --}}
@extends('adminlte::page')

{{-- Le asignamos en sufijo al titlo de la pagina --}}
@section('title_postfix', 'Prioridad')

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
            <h3 class="card-title"><a href="{{ route('home') }}">Codeway</a>/<a href="{{ route('priority.index') }}">Prioridad</a></h3>
        </div>
    </div>
@endsection

{{-- Aquí va todo el contenido que queramos mostrar --}}
@section('content')
    <div>
        @livewire('priority-component')
    </div>
@endsection

{{-- Esta es la seccion para agregar JS --}}
@section('js')
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

    <script>
        var table = $('#priorityTable').DataTable( {
            "ajax": "{{ route('datatable.priority') }}",
            "columns": [
                {data: 'id'},
                {data: 'description'},
                {data: 'status'},
                {data: 'created_at'},
                {data: 'updated_at'},
                {data: '---'},
            ],
            "columnDefs": [ {
                "targets": -1,
                "data": "veamos",
                "defaultContent": "<button class='btn btn-info'>Show</button>"
            } ]
        } );

        $('#priorityTable tbody').on( 'click', 'button', function () {
            var data = table.row( $(this).parents('tr') ).data();
            alert( table.row( this ).data() );
        } );
    </script>

    <script>
        $('#priorityTables').DataTable({
            /* "ajax": "{{ route('datatable.priority') }}",
            "columns": [
                {data: 'id'},
                {data: 'description'},
                {data: 'status'},
                {data: 'created_at'},
                {data: 'updated_at'},
                {data: 'updated_at'},
            ], */


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


            /* configuración por defecto
            "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Ningun registro coincide con la busqueda",
            "info": "Mostrando la página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay resultados disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search" : "Buscar :",
            "paginate" : {
                "next" : "Siguiente",
                "previous" : "Anterior",
            }
             */
        //}
        });
    </script>

    <script>
        window.addEventListener('openCreatePriorityModal', event => {
            $("#createPriority").modal('show');
        })

        window.addEventListener('closeCreatePriorityModal', event => {
            $("#createPriority").modal('hide');
        })

        $(document).ready(function(){
            $("#createPriority").on('hidden.bs.modal', function(){
                livewire.emit('forcedCloseModal');
            });
        });

        window.addEventListener('openShowPriorityModal', event => {
            $("#showPriority").modal('show');
        })

        window.addEventListener('closeShowPriorityModal', event => {
            $("#showPriority").modal('hide');
        })

        window.addEventListener('openUpdatePriorityModal', event => {
            $("#updatePriority").modal('show');
        })

        window.addEventListener('closeUpdatePriorityModal', event => {
            $("#updatePriority").modal('hide');
        })

        window.addEventListener('openDeletePriorityModal', event => {
            $("#deletePriority").modal('show');
        })

        window.addEventListener('closeDeletePriorityModal', event => {
            $("#deletePriority").modal('hide');
        })

    </script>
@endsection
{{-- Es la imagen que mostrara cuando aún no termine de cargar completamente la pagina --}}
{{-- <img src="{{ asset('favicons/android-icon-192x192.png') }}" alt="CODEWAY"> --}}
