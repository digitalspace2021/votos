@extends('layouts.base')

@section('titulo')
    Cumpleanios Usuarios
@endsection

@section('css-extra')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <!-- Select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Cumpleaños usuarios</h1>
        <p class="fs-5 text-muted">
            Aqui se muestran los cumpleaños de los usuarios registrados como Usuarios, ediles, asambleistas y candidatos
        </p>
    </div>

    <div class="container">
    </div>
@endsection

@section('cuerpo')
    <div class="container">
        <div class="table-responsive">
            <table class="custom-table text-center" id="tabla-cumple">
                <thead>
                    <tr>
                        <th>Identficacion</th>
                        <th>Nombre</th>
                        <th>Rol</th>
                        <th>Fecha</th>
                        <th>Falta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('js-extra')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $("#tabla-cumple").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('cumpleanios.getAll') }}",
            columns: [
                {data: 'identificacion', name: 'identificacion'},
                {data: 'name', name: 'name'},
                {data: 'rol', name: 'rol'},
                {data: 'fecha_nacimiento', name: 'fecha_nacimiento'},
                {data: 'falta', name: 'falta'},
                {data: 'acciones', name: 'acciones', orderable: false, searchable: false},
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json"
            },
            order: [[ 4, "asc" ]]
        })
    </script>
    
@endsection