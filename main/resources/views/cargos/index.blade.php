@extends('layouts.base')

@section('titulo')
    Cargos
@endsection

@section('css-extra')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Cargos</h1>
        <p class="fs-5 text-muted">Aqui podras encontrar la gestion de cargos, solo los administradores pueden crear,
            editar y eliminar cargos.</p>
    </div>

    @if (Auth::user()->hasRole('administrador'))
        <div class="row">
            <div class="col-10">
            </div>
            <div class="col-2 mb-2 text-right">
                <a href="{{ route('cargos.crear') }}" class="btn btn-success">Crear cargo</a>
            </div>
        </div>
    @endif
@endsection

@section('cuerpo')
    <div class="table-responsive">
        <table class="table text-center" id="tablas-cargos">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
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
            $('#tablas-cargos').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json',
                },
                ajax: "{!! route('cargos.tabla') !!}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
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
