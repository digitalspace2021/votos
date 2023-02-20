@extends('layouts.base')

@section('titulo')
    Candidatos
@endsection

@section('css-extra')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Candidatos</h1>
        <p class="fs-5 text-muted">Aqui podras encontrar la gestion de candidatos, solo los administradores pueden crear,
            editar y eliminar candidatos.</p>
    </div>

    @if (Auth::user()->hasRole('administrador'))
        <div class="row">
            <div class="col-10">
            </div>
            <div class="col-2 mb-2 text-right">
                <a href="{{ route('candidatos.crear') }}" class="btn btn-success">Crear candidato</a>
            </div>
        </div>
    @endif
@endsection

@section('cuerpo')
    <div class="table-responsive">
        <table class="table text-center" id="tablas-candidatos">
            <thead>
                <tr>
                    <th>Nombre completo</th>
                    <th>Cedula</th>
                    <th>Cargo</th>
                    <th>Teléfono</th>
                    <th>Fecha actualizacion</th>
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
            $('#tablas-candidatos').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json',
                },
                ajax: "{!! route('candidatos.tabla') !!}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'identifcacion',
                        name: 'identifcacion'
                    },
                    {
                        data: 'cargo',
                        name: 'cargo'
                    },
                    {
                        data: 'telefono',
                        name: 'telefono'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
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
