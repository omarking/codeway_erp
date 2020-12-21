{{-- Extendemos de la plantilla Admin LTE --}}
@extends('adminlte::page')
{{-- Le asignamos en sufijo al titlo de la pagina --}}
@section('title_postfix', 'Home')
{{-- Asi podemos hacer uso de un plugin, en este caso Sweet Alert 2 --}}
@section('plugins.Sweetalert2', true)
{{-- Este es la seccion del header en el body de la plantilla Admin LTE --}}
@section('content_header')
    <h1>Codeway</h1>
@stop
{{-- Aquí va todo el contenido que queramos mostrar --}}
@section('content')
    <p>Welcome</p>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Livewire</h1>
        </div>
        @livewire('counter')
    </div>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Users</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-success table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">User</th>
                            <th scope="col">Email</th>
                            <th scope="col">Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->nameUser }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @isset($user->roles[0]->name)
                                        {{ $user->roles[0]->name }}
                                    @else
                                        - - - -
                                    @endisset
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
            {{-- <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    {{ $users->links() }}
                </ul>
            </nav> --}}
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Projects</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-success table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Key</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Responsable</th>
                            <th scope="col">Class</th>
                            <th scope="col">Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <th scope="row">{{ $project->id }}</th>
                                <td>{{ $project->key }}</td>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->description }}</td>
                                <td>{{ $project->responsable }}</td>
                                <td>
                                    @isset($project->clas->description)
                                        {{ $project->clas->description }}
                                    @endisset
                                </td>
                                <td>
                                    @isset($project->category->description)
                                        {{ $project->category->description }}
                                    @endisset
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $projects->links() }}
            </div>
            {{-- {{ $projects->links() }} --}}
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Task</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-success table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">file</th>
                            <th scope="col">Start</th>
                            <th scope="col">End</th>
                            <th scope="col">Informer</th>
                            <th scope="col">Responsable</th>
                            <th scope="col">Status</th>
                            <th scope="col">Priority</th>
                            <th scope="col">Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <th scope="row">{{ $task->id }}</th>
                                <td>{{ $task->name }}</td>
                                <td>{{ $task->file }}</td>
                                <td>{{ $task->start }}</td>
                                <td>{{ $task->end }}</td>
                                <td>{{ $task->informer }}</td>
                                <td>{{ $task->responsable }}</td>
                                <td>
                                    @isset($task->statu->description)
                                        {{ $task->statu->description }}
                                    @endisset
                                </td>
                                <td>
                                    @isset($task->priority->description)
                                        {{ $task->priority->description }}
                                    @endisset
                                </td>
                                <td>
                                    @isset($task->type->description)
                                        {{ $task->type->description }}
                                    @endisset
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    {{ $tasks->links() }}
                </ul>
            </nav> --}}
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Holidays</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-success table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Days</th>
                            <th scope="col">begin</th>
                            <th scope="col">End</th>
                            <th scope="col">InProcess</th>
                            <th scope="col">Taken</th>
                            <th scope="col">Availables</th>
                            <th scope="col">Responsable</th>
                            <th scope="col">Absence</th>
                            <th scope="col">Period</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($holidays as $holiday)
                            <tr>
                                <th scope="row">{{ $holiday->id }}</th>
                                <td>{{ $holiday->days }}</td>
                                <td>{{ $holiday->beginDate }}</td>
                                <td>{{ $holiday->endDate }}</td>
                                <td>{{ $holiday->inProcess }}</td>
                                <td>{{ $holiday->taken }}</td>
                                <td>{{ $holiday->available }}</td>
                                <td>{{ $holiday->responsable }}</td>
                                <td>
                                    @isset($holiday->absence->description)
                                        {{ $holiday->absence->description }}
                                    @endisset
                                </td>
                                <td>
                                    @isset($holiday->period->description)
                                        {{ $holiday->period->description }}
                                    @endisset
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    {{ $holidays->links() }}
                </ul>
            </nav> --}}
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Departaments</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-success table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Responsable</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departaments as $departament)
                            <tr>
                                <th scope="row">{{ $departament->id }}</th>
                                <td>{{ $departament->name }}</td>
                                <td>{{ $departament->description }}</td>
                                <td>{{ $departament->status }}</td>
                                <td>{{ $departament->responsable }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    {{ $departaments->links() }}
                </ul>
            </nav> --}}
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Groups</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-success table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Responsable</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groups as $group)
                            <tr>
                                <th scope="row">{{ $group->id }}</th>
                                <td>{{ $group->name }}</td>
                                <td>{{ $group->description }}</td>
                                <td>{{ $group->status }}</td>
                                <td>{{ $group->responsable }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    {{ $groups->links() }}
                </ul>
            </nav> --}}
        </div>
    </div>
@stop

{{-- En esta seccion va algun estilo CSS que queramos agregar --}}
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
{{-- Aqui va un script JS que queramos agregar como un script de un plugin --}}
@section('js')
    {{-- <script>
        Swal.fire(
            'Good job!',
            'You clicked the button!',
            'success'
        )

        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your imaginary file is safe :)',
            'error'
            )
        }
        })
    </script> --}}
@stop

{{-- Es la imagen que mostrara cuando aún no termine de cargar completamente la pagina --}}
{{-- <img src="{{ asset('favicons/android-icon-192x192.png') }}" alt="CODEWAY"> --}}
