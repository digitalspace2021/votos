@extends('layouts.base')

@section('titulo')
Posibles Votantes
@endsection

@section('css-extra')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
    rel="stylesheet" />

<style>
    .select2-container {
        z-index: 100000;
    }
</style>
@endsection

@section('cabecera')
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">Posibles Votantes</h1>
    <p class="fs-5 text-muted">Aqui podras encontrar la gestion de Posibles Votantes, solo los administradores pueden
        crear,
        editar y eliminar usuarios. Teniendo en cuenta que esta seccion tiene relacion con la parte de los formularios
    </p>
</div>


<div class="container m-3">
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
</div>

@if (session('success') || session('error'))
<div class="alert alert-{{session('success') ? 'success' : 'danger'}} mx-2">
    {{session('success') ?? session('error')}}
</div>
@endif

<div class="row mb-3">
    <div class="col-md-6 d-flex justify-content-start">
        @if (Auth::user()->hasRole('administrador'))
            <button class="btn btn-sm btn-success" id="exportar">Exportar</button>
        @endif
    </div>
    <div class="col-md-6 d-flex justify-content-end">
        <a href="{{ route('problems.create') }}" class="btn btn-sm btn-success">Crear Votante</a>
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

@include('problems.modals.address-modal', ['candidatos' => $candidatos])


@section('js-extra')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
            viewData();

            $('#btnFiltrar').click(function() {
                let cedula = $('#InputCedula').val();
                let nombre = $('#InputNombre').val();
                let fecha = $('#inputDate').val();
                let creador = $('#selectCreador').val();
                $('#table_problem').DataTable().destroy();
                viewData(cedula, nombre, fecha, creador);
            });

            $('#btnClear').click(function() {
                $('#InputCedula').val('');
                $('#InputNombre').val('');
                $('#inputDate').val('');
                $('#selectCreador').val('');
                $('#table_problem').DataTable().destroy();
                viewData();
            });

            $('#exportar').click(function() {
                exportar();
            });
        });

        function viewData(cedula = null, nombre = null, fecha = null, creador = null) {
            $('#table_problem').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                order: [],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json',
                },
                ajax: {
                    url: "{!! route('problems.getAll') !!}",
                    data: {
                        cedula: cedula,
                        nombre: nombre,
                        fecha: fecha,
                        creador: creador
                    }
                },
                columns: [{
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
        }

        function exportar(){
            let cedula = $('#InputCedula').val();
            let nombre = $('#InputNombre').val();
            let fecha = $('#inputDate').val();
            let creador = $('#selectCreador').val();
            window.location.href = "{{ route('problems.export') }}?cedula="+cedula+"&nombre="+nombre+"&fecha="+fecha+"&creador="+creador;
        }
</script>

<script>
    /* $("#changeStatus").modal('show'); */
        /* redady doc */
        $(document).ready(function() {
            /* change status */
            $(document).on('click', '.status', function() {
                let id = $(this).attr('prid');
                let apo = $(this).attr('apo');
                let cotainerSelect = $("#select_cand");
                let url = "{{ route('problems.changeStatus', ':id') }}";
                url = url.replace(':id', id);
                $("#changeStatus form").attr('action', url);
                /* call attribute in prid get value */
                $("#changeStatus form input[name='problem_id']").val($(this).attr('prid'));

                if (apo==1) {
                    cotainerSelect.hide();
                    /* remove required to select inside */
                    $("#changeStatus form select[name='candidato_id']").removeAttr('required');
                }else{
                    cotainerSelect.show();
                    /* add required to select inside */
                    $("#changeStatus form select[name='candidato_id']").attr('required', 'required');
                }

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
                },
                placeholder: 'Seleccione una zona',
                dropdownParent: $("#changeStatus"),
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
                    $("#label_zona").html('Vereda');
                } else {
                    $("#label_zona").html('Barrio');
                }
            });


            $('#candidatos').select2({
                multiple: true,
                dropdownParent: $("#changeStatus"),
                width: '100%',
            })
        });

        $('#candidato_id').on('click', function(event) {
  event.stopPropagation();
});
</script>
@endsection