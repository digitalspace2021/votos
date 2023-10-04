@extends('layouts.base')

@section('titulo')
Historial de votaciones
@endsection

@push('custom-css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
    rel="stylesheet" />

<style>
    .select2-container {
        z-index: 100000;
    }
</style>
@endpush

@section('cabecera')
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">Historial de votaciones</h1>
    <p class="fs-5 text-muted">Aqui se tendra registro de las votaciones hechas en base a los formularios registrados,
        diciendo si voto o no.</p>
</div>


{{-- <div class="container m-3">
    <!-- filtros -->

    <div class="row">
        <div class="col-md-6">
            <label for="">Por cedula</label>
            <input type="text" class="form-control" placeholder="123456789" aria-label="First name" id="InputCedula">
        </div>
        <div class="col-md-6">
            <label for="">Por nombre</label>
            <input type="text" class="form-control" placeholder="Nombre" aria-label="First name" id="InputNombre">
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <label for="">Por fecha</label>
            <input class="form-control" type="date" id="inputDate">
        </div>

        <div class="col-md-4">
            @if (Auth::user()->hasRole('administrador'))
            <label for="">Por creador</label>
            <select class="form-select" aria-label="Default select example" id="selectCreador">
                <option value="" selected>Filtrar por creador</option>
                @foreach ($creadores as $creador)
                <option value="{{$creador->id}}">{{$creador->name}}</option>
                @endforeach
            </select>
            @endif
        </div>
        <div class="col-md-4 d-flex justify-content-around align-items-center mt-4">
            <button class="btn btn-danger" id="btnClear">Limpiar</button>
            <button class="btn btn-warning" id="btnFiltrar">Filtrar</button>
        </div>

    </div>
    <!-- End filtros -->
    <hr>
</div> --}}

@if (session('success') || session('error'))
<div class="alert alert-{{session('success') ? 'success' : 'danger'}} mx-2">
    {{session('success') ?? session('error')}}
</div>
@endif

<div class="row mb-3">
    <div class="d-flex align-items-center justy-content-between">
        <div class="col-md-4 d-flex justify-content-start">
            @if (Auth::user()->hasRole('administrador'))
            <button class="btn btn-sm btn-success" id="exportar">Exportar</button>
            @endif
        </div>

        <div class="col-md-6 d-flex justify-content-end">
            <a href="{{ route('votos.create') }}" class="btn btn-sm btn-success">Crear Votante</a>
        </div>
    </div>
</div>
@endsection

@section('cuerpo')
<div class="table-responsive">
    <table class="table text-center" id="table_votos">
        <thead>
            <tr>
                <th>Identificacion</th>
                <th>Creador</th>
                <th>Ubicacion</th>
                <th>Voto</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('custom-js')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function(){
        viewTable();

        function viewTable(candidato,creador,cedula,nombre,comuna,barrio,corregimiento,vereda,fecha){
            $('#table_votos').DataTable({
                processing: true,
                serverSide: true,
                order: [],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json',
                },
                ajax: {
                url: "{!! route('votos.getAll') !!}",
                type: "GET",
            },
                columns: [
                    {
                        data: 'identificacion',
                        name: 'identificacion'
                    },
                    {
                        data: 'creador',
                        name: 'creador'
                    },
                    {
                        data: 'ubicacion',
                        name: 'ubicacion'
                    },
                    {
                        data: 'voto',
                        name: 'voto'
                    },
                    {
                        data: 'fecha',
                        name: 'fecha'
                    },
                    {
                        data: 'acciones',
                        name: 'acciones'
                    }
                ]
            });
        }
    })
</script>
@endpush