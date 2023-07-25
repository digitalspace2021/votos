@extends('layouts.base')

@section('titulo')
    {{$type}}s
@endsection

@section('css-extra')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">
            {{$type}}s
        </h1>
        <p class="fs-5 text-muted">
            @if ($type == 'Asambleista')
                Aqui podras encontrar la gestion de usuarios asambleistas, solo los administradores pueden crear,
                editar y eliminar usuarios.
            @endif

            @if ($type == 'Edil')
                Aqui podras encontrar la gestion de usuarios ediles, solo los administradores pueden crear,
                editar y eliminar usuarios.
            @endif
        </p>
    </div>

    @if (Auth::user()->hasRole('administrador'))
        <div class="row">
            <div class="col-10">
            </div>
            <div class="col-2 mb-2 text-right">
                <a href="{{route('users-edils.create', ['type' => $type])}}" class="btn btn-success">Crear {{$type}}</a>
            </div>
        </div>
    @endif
@endsection

@section('cuerpo')
    <div class="table-responsive">
        <table class="table text-center" id="tablas-usuarios">
            <thead>
                <tr>
                    <th>Identificacion</th>
                    <th>Nombre completo</th>
                    <th>Email</th>
                    <th>Direccion</th>
                    <th>Fecha creacion</th>
                    <th>Accion</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('js-extra')
@php
    $route = route('users-edils.getAll', ['type' => $type])
@endphp
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        let route = "{{$route}}"
        $(document).ready(function() {
            $('#tablas-usuarios').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json',
                },
                ajax: route,
                columns: [{
                        data: 'identificacion',
                        name: 'identificacion'
                    },
                    {
                        data: 'nombre_completo',
                        name: 'nombre_completo'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'direccion',
                        name: 'direccion'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'acciones',
                        name: 'acciones'
                    }
                ]
            });
        })
    </script>
@endsection