@extends('layouts.base')

@section('titulo')
    Usuarios
@endsection

@section('css-extra')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
    rel="stylesheet" />
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Usuarios</h1>
        <p class="fs-5 text-muted">Aqui podras encontrar la gestion de usuarios, solo los administradores pueden crear,
            editar y eliminar usuarios.</p>
    </div>

    @if (Auth::user()->hasRole('administrador'))
        <div class="row">
            <div class="col-10">
            </div>
            <div class="col-2 mb-2 text-right">
                <a href="{{ route('usuarios.crear') }}" class="btn btn-success">Crear usuario</a>
            </div>
        </div>
    @endif

    @if (session('success') || session('error'))
        <div class="alert alert-{{session('success') ? 'success' : 'danger'}} mx-2">
            {{session('success') ?? session('error')}}
        </div>
    @endif
@endsection

@section('cuerpo')
    <div class="table-responsive">
        <table class="table text-center" id="tablas-usuarios">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre completo</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Fecha actualizacion</th>
                    <th>Accion</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@include('usuarios.modals.canidato-modal')

@section('js-extra')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tablas-usuarios').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json',
                },
                ajax: "{!! route('usuarios.tabla') !!}",
                columns: [{
                        data: 'identificacion',
                        name: 'identificacion',
                        visible: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'rol',
                        name: 'rol'
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

            $(document).on('click', '.generate', function() {
                let id = $(this).attr('user_id');
                let cotainerSelect = $("#select_cand");
                let url = "{{ route('usuarios.form', ':id') }}";
                url = url.replace(':id', id);
                $("#changeStatus form").attr('action', url);

                $("#changeStatus").modal('show');
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
                    },
                    placeholder: 'Buscar candidato',
                    width: '100%',
                    dropdownParent: $("#changeStatus")

            });
        })
    </script>
@endsection
