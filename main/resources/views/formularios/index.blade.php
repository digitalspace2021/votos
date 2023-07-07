@extends('layouts.base')

@section('titulo')
    Formularios
@endsection

@section('css-extra')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Formularios</h1>
        <p class="fs-5 text-muted">Aqui podras encontrar la gestion de formularios, solo los administradores pueden crear,
            editar y eliminar formularios.

        <div class="actions">
            <a href="{{ route('import.view') }}" class="btn btn-sm btn-success">
                <i class="fa fa-upload"></i>
                Importar </a>
        </div>
        </p>
    </div>

    <div class="row">
        @if (Auth::user()->hasRole(['administrador']))
            <div class="col-10">
                <a href="{{ route('export.forms') }}" class="btn  btn-sm btn-success">Exportar</a>
            </div>
        @endif
        @if (Auth::user()->hasRole(['administrador', 'simple']))
            <div class="col-2 mb-2 text-center">
                <a href="{{ route('formularios.crear') }}" class="btn  btn-sm btn-success">Crear formulario</a>
            </div>
        @endif
    </div>
@endsection

@section('cuerpo')
    <div class="table-responsive">
        <table class="table text-center" id="tablas-formularios">
            <thead>
                <tr>
                    <th>Creador</th>
                    <th>Identificación</th>
                    <th>Nombre completo</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Dirección</th>
                    <th>Puesto de votacion</th>
                    <th>Fecha Creado</th>
                    <th>Accion</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('js-extra')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tablas-formularios').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json',
                },
                ajax: "{!! route('formularios.tabla') !!}",
                columns: [{
                        data: 'creador',
                        name: 'creador'
                    },
                    {
                        data: 'identificacion',
                        name: 'identificacion'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'email',
                        name: 'email'
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
                        data: 'puesto_votacion',
                        name: 'puesto_votacion'
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
