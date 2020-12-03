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
    <p>Aqui debo mostrar el contenido</p>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Titulo de algo</h1>
        </div>
        <div class="card-body">
            <br>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem sunt architecto, suscipit magni consequuntur tenetur est vero accusantium eius tempore explicabo nobis minus molestiae minima asperiores eos quia? Quisquam, excepturi.
            <br>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque omnis, enim assumenda beatae id ullam aliquam facere officia ad commodi tempora velit aperiam voluptas dolorem nam repellendus. Sed, modi aliquam.
        </div>
    </div>

     <div class="card">
        <div class="card-header">
            <h1 class="card-title">Livewire</h1>
        </div>
        @livewire('counter')
    </div>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Titulo de algo</h1>
        </div>
        <div class="card-body">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque omnis, enim assumenda beatae id ullam aliquam facere officia ad commodi tempora velit aperiam voluptas dolorem nam repellendus. Sed, modi aliquam.
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Titulo de algo</h1>
        </div>
        <div class="card-body">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur maxime voluptatum illo, libero eligendi eveniet rerum, fuga voluptatibus hic doloribus in sed est praesentium odit suscipit exercitationem magni quaerat rem.
            <br>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem sunt architecto, suscipit magni consequuntur tenetur est vero accusantium eius tempore explicabo nobis minus molestiae minima asperiores eos quia? Quisquam, excepturi.
            <br>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque omnis, enim assumenda beatae id ullam aliquam facere officia ad commodi tempora velit aperiam voluptas dolorem nam repellendus. Sed, modi aliquam.
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Titulo de algo</h1>
        </div>
        <div class="card-body">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius animi, eveniet, iure, earum odio deserunt pariatur nisi voluptas iste perspiciatis reiciendis doloribus. Corporis cupiditate, officiis illo vel ut est voluptates.
            <br>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem sunt architecto, suscipit magni consequuntur tenetur est vero accusantium eius tempore explicabo nobis minus molestiae minima asperiores eos quia? Quisquam, excepturi.
            <br>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque omnis, enim assumenda beatae id ullam aliquam facere officia ad commodi tempora velit aperiam voluptas dolorem nam repellendus. Sed, modi aliquam.
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Titulo de algo</h1>
        </div>
        <div class="card-body">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque omnis, enim assumenda beatae id ullam aliquam facere officia ad commodi tempora velit aperiam voluptas dolorem nam repellendus. Sed, modi aliquam.
            <br>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem sunt architecto, suscipit magni consequuntur tenetur est vero accusantium eius tempore explicabo nobis minus molestiae minima asperiores eos quia? Quisquam, excepturi.
            <br>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem sunt architecto, suscipit magni consequuntur tenetur est vero accusantium eius tempore explicabo nobis minus molestiae minima asperiores eos quia? Quisquam, excepturi.
        </div>
    </div>
@stop

{{-- En esta seccion va algun estilo CSS que queramos agregar --}}
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
{{-- Aqui va un script JS que queramos agregar como un script de un plugin --}}
@section('js')
    <script>
        /* Swal.fire(
            'Good job!',
            'You clicked the button!',
            'success'
        ) */

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
    </script>
@stop

{{-- Es la imagen que mostrara cuando aún no termine de cargar completamente la pagina --}}
{{-- <img src="{{ asset('favicons/android-icon-192x192.png') }}" alt="CODEWAY"> --}}
