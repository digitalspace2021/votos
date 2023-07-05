@extends('layouts.base')

@section('titulo')
Problematicas
@endsection

@section('css-extra')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('cabecera')
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">Problematicas</h1>
    <p class="fs-5 text-muted">Aqui podras encontrar la gestion de problematicas, solo los administradores pueden crear,
        editar y eliminar usuarios. Teniendo en cuenta que esta seccion tiene relacion con la parte de los formularios
    </p>
</div>


@if (session('success') || session('error'))
<div class="alert alert-{{session('success') ? 'success' : 'danger'}} mx-2">
    {{session('success') ?? session('error')}}
</div>
@endif

<div class="row">
    <div class="col-10">
    </div>
    <div class="col-2 mb-2 text-right">
        <a href="{{ route('problems.create') }}" class="btn btn-success">Crear Problematica</a>
    </div>
</div>
@endsection

@section('cuerpo')
<div class="table-responsive">
    <table class="table text-center" id="table_problem">
        <thead>
            <tr>
                <th>Identificacion</th>
                <th>Nombre Completo</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Responsable</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>
</div>
@endsection


@section('js-extra')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table_problem').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json',
                },
                ajax: "{!! route('problems.getAll') !!}",
                columns: [
                    {
                        data: 'identificacion',
                        name: 'identificacion'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'telefono',
                        name: 'telefono'
                    },
                    {
                        data: 'direccion',
                        name: 'direccion'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'acciones',
                        name: 'acciones',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        })
    </script>
@endsection