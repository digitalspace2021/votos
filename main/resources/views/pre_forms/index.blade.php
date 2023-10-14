@extends('layouts.base')

@section('titulo')
Preview Formularios
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

<!-- Select 2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
@endsection

@section('cabecera')
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">Preview Formularios</h1>
    <p class="fs-5 text-muted">Aqui se gestionara los formularios de los votantes que hallan sido importados desde la
        aplicacion, con el fin de primero confirmar la informacion para posterior contarla en las metricas de la
        aplicacion.
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

        {{-- @if (auth()->user()->hasRole('admin'))
        <div class="col-md-4">
            <label for="">Por creador</label>
            <select class="form-select" aria-label="Default select example" id="selectCreador">
                <option value="" selected>Filtrar por creador</option>
                @foreach ($creadores as $creador)
                <option value="{{$creador->id}}">{{$creador->name}}</option>
                @endforeach
            </select>
        </div>
        @endif --}}
        <div class="col-md-4">
            <label for="">Por Puesto</label>
            <select class="form-select" aria-label="Default select example" id="selectPV">
                <option value="" selected>Filtrar por puesto</option>
                <option value="no">No tienen puesto</option>
                @foreach ($puestos as $puesto)
                <option value="{{$puesto->id}}">{{$puesto->puesto_nombre}}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label for="">Por candidato</label>
            <select class="form-select" aria-label="Default select example" id="selectCandidato">
                <option value="" selected>Filtrar por candidato</option>
                @foreach ($candidatos as $candidato)
                <option value="{{$candidato->id}}">{{$candidato->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label for="">Por Comuna</label>
            <select class="form-select" aria-label="Default select example" id="selectComuna">
                <option value="" selected>Filtrar por comuna</option>
                @foreach ($comunas as $comuna)
                <option value="{{$comuna->id}}">{{$comuna->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="">Por Barrio</label>
            <select class="form-select" aria-label="Default select example" id="selectBarrio">
                <option value="" selected>Filtrar por barrio</option>
                @foreach ($barrios as $barrio)
                <option value="{{$barrio->id}}">{{$barrio->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="">Por corregimiento</label>
            <select class="form-select" aria-label="Default select example" id="selectCorregimiento">
                <option value="" selected>Filtrar por corregimiento</option>
                @foreach ($corregimientos as $corregimiento)
                <option value="{{$corregimiento->id}}">{{$corregimiento->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="">Por Vereda</label>
            <select class="form-select" aria-label="Default select example" id="selectVereda">
                <option value="" selected>Filtrar por vereda</option>
                @foreach ($veredas as $vereda)
                <option value="{{$vereda->id}}">{{$vereda->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12 d-flex justify-content-around align-items-center mt-4">
            <button class="btn btn-danger" id="btnClear">Limpiar</button>
            <button class="btn btn-warning" id="btnFiltrar">Filtrar</button>
        </div>
    </div>
    <div class="row">
        <div class="d-flex align-items-center justy-content-between">
            @if (Auth::user()->hasRole(['administrador']))
            <div class="col-2">
                <a href="{{ route('pre-formularios.export') }}" class="btn  btn-sm btn-warning">Exportar</a>
            </div>
            <div class="col-2">
                @include('components.options-forms', ['route' => route('pre-formularios.delete.all'), 'table'=>'pre_forms', 'route_approved' => route('pre-formularios.aprobar.all')])
            </div>
            @endif
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

@if (Session::has('message'))
<p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
@endif

@endsection

@section('cuerpo')
<div class="table-responsive">
    <table class="table text-center" id="pre_forms">
        <thead>
            <tr>
                <th></th>
                <th>Identificacion</th>
                <th>Nombre Completo</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Candidatos</th>
                <th>Responsable</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@include('pre_forms.modals.address-modal')


@section('js-extra')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
    //inicializar select 2 (funcion de busqueda en los selects)
    $(document).ready(function() {
    $('#selectCandidato').select2({
            theme: 'bootstrap-5'
    });
    $('#selectCreador').select2({
        theme: 'bootstrap-5'
    });
    $('#selectComuna').select2({
        theme: 'bootstrap-5'
    });
    $('#selectBarrio').select2({
        theme: 'bootstrap-5'
    });
    $('#selectCorregimiento').select2({
        theme: 'bootstrap-5'
    });
    $('#selectVereda').select2({
        theme: 'bootstrap-5'
    });
});

</script>
<script>
    $(document).ready(function() {
            viewData();

            $('#btnFiltrar').click(function() {
                let cedula = $('#InputCedula').val();
                let nombre = $('#InputNombre').val();
                let fecha = $('#inputDate').val();
                let creador = $('#selectCreador').val();
                let candidato = $('#selectCandidato').val();
                let comuna = $('#selectComuna').val();
                let barrio = $('#selectBarrio').val();
                let corregimiento = $('#selectCorregimiento').val();
                let vereda = $('#selectVereda').val();
                let puesto = $('#selectPV').val();

                $('#pre_forms').DataTable().destroy();
                viewData(cedula, nombre, fecha, creador, candidato, comuna, barrio, corregimiento, vereda, puesto);
            });

            $('#btnClear').click(function() {
                $('#InputCedula').val('');
                $('#InputNombre').val('');
                $('#inputDate').val('');
                $('#selectCreador').val('');
                $('#pre_forms').DataTable().destroy();
                $('#selectCandidato').val('');
                $('#selectComuna').val('');
                $('#selectBarrio').val('');
                $('#selectCorregimiento').val('');
                $('#selectVereda').val('');
                $('#selectPV').val('');

                viewData();
            });

            $('#exportar').click(function() {
                exportar();
            });
        });

        function viewData(cedula = null, nombre = null, fecha = null, creador = null, candidato = null, comuna = null, barrio = null, corregimiento = null, vereda = null, puesto = null) {
            $('#pre_forms').DataTable({
                processing: true,
                serverSide: true,
                order: [],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json',
                },
                ajax: {
                    url: "{!! route('pre-formularios.tabla') !!}",
                    data: {
                        cedula: cedula,
                        nombre: nombre,
                        fecha: fecha,
                        creador: creador,
                        candidato: candidato,
                        comuna: comuna,
                        barrio: barrio,
                        corregimiento: corregimiento,
                        vereda: vereda,
                        puesto: puesto
                    }
                },
                columns: [
                    {
                        data: 'select',
                        name: 'select'
                    },
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
                        data: 'candidatos',
                        name: 'candidatos'
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
                let url = "{{ route('pre-formularios.aprobar', ':id') }}";
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
                    $("#label_zona").html('Vereda');
                } else {
                    $("#label_zona").html('Barrio');
                }
            });


            $('#candidato_id').select2({
                    theme: "bootstrap",
                    ajax: {
                        dataType: 'json',
                        url: "{!! route('util.lista_candidatos') !!}",
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

            $('#candidato_id').on('select2:select', function(e) {
                var data = e.params.data;
                $('#candidato_id').val(data.id);
            });

            $("#selectPV").select2({
                theme: "bootstrap",
            });
        });
</script>
@endsection