@extends('layouts.base')

@section('titulo')
Problematicas
@endsection

@section('css-extra')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
        rel="stylesheet" />

    <style>
    .select2-container{
        z-index:100000;
    }
    </style>
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
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@include('problems.modals.address-modal')


@section('js-extra')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
                        data: 'nombre_completo',
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
                        data: 'created_at',
                        name: 'created_at'
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

    <script>
        /* $("#changeStatus").modal('show'); */
        /* redady doc */
        $(document).ready(function() {
            /* change status */
            $(document).on('click', '.status', function() {
                let id = $(this).attr('prid');
                let url = "{{ route('problems.changeStatus', ':id') }}";
                url = url.replace(':id', id);
                $("#changeStatus form").attr('action', url);
                /* call attribute in prid get value */
                $("#changeStatus form input[name='problem_id']").val($(this).attr('prid'));
                $("#changeStatus").modal('show');
            });

            $('#zona').select2({
                theme: "bootstrap",
                ajax: {
                    dataType: 'json',
                    url: function(params) {
                        return "/get_veredas_and_comunas?type=" + $('#tipo_zona').val();
                    },
                    type: "get",
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
            $('#zona').on('select2:select', function(e) {
                var data = e.params.data;
                $('#zona').val(data.id);
            });

            $(".close").click(function() {
                $("#changeStatus").modal('hide');
            });

            $("#tipo_zona").change(function() {
                if ($(this).val() == 'Corregimiento') {
                    $("#label_zona").html('Corregimiento');
                } else {
                    $("#label_zona").html('Comuna');
                }
            });
        });
    </script>
@endsection