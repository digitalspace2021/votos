@extends('layouts.base')

@section('titulo')
    Crear formulario
@endsection

@section('css-extra')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
        rel="stylesheet" />
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Importar formularios</h1>
    </div>
@endsection


@if (Session::has('message'))
    <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
@endif

@section('cuerpo')
    <div class="container">
        <div class="row g-5">
            <div class="col-3"></div>
            <div class="col-7">

                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text text-danger">{{ $error }}</li>
                    @endforeach
                </ul>

                <form class="needs-validation" enctype="multipart/form-data" method="POST"
                    action="{{ route('import.form') }}" novalidate>
                    @csrf
                    <input type="hidden" name="creador_id" id="creador_id"
                        @if (Auth::user()->hasRole('simple')) value="{{ Auth::user()->id }}" @endif>

                    <div class="row g-3">

                        <div class="col-12">
                            <label for="candidato_id" class="form-label">Candidato</label>
                            <select class="form-control" name="candidato_id" id="candidato_id" required></select>
                            <div class="invalid-feedback">
                                Este campo es requerido.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="creador" class="form-label">Quien lo diligencia</label>
                            <select class="form-control" name="creador" id="creador" required
                                @if (Auth::user()->hasRole('simple')) disabled @endif>
                                @if (Auth::user()->hasRole('simple'))
                                    <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                @else
                                    <option value=""></option>
                                @endif
                            </select>
                            <div class="invalid-feedback">
                                Este campo es requerido.
                            </div>
                        </div>


                        <div class="col-6">
                            <label for="tipo_zona" class="form-label">Tipo de ubicacion</label>
                            <select name="tipo_zona" id="tipo_zona" class="form-control" required>
                                <option value="0">Seleccion el tipo de zona</option>
                                <option value="Comuna">Comuna</option>
                                <option value="Corregimiento">Corregimiento</option>
                            </select>
                            <div class="invalid-feedback">
                                Seleccion un tipo de zona valido
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="zona" class="form-label" id="label_zona">Comuna / Corregimiento</label>
                            <select class="form-control" name="zona" id="zona" required></select>
                            <div class="invalid-feedback">
                                Por favor ingresa tu Comuna / Corregimiento.
                            </div>
                        </div>

                        {{-- <input type="file" class="custom-up" name="file" id="fileUp"> --}}

                        <div class="row d-flex justify-content-center align-items-center mt-3">
                            <div class="btn btn-warning btn-lg" id="add_files" type="button">
                                <i class="fas fa-plus"></i>
                                Agregar archivos
                            </div>
                        </div>


                        <div class="mt-2" id="content_files" style="width: 100%">
                            {{-- <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="file" name="" id="" class="form-control">
                                        <button class="btn btn-danger" title="Quitar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <select name="tipo_zona" id="tipo_zona" class="form-control" required>
                                        <option value="0">Seleccion el tipo de zona</option>
                                        <option value="Comuna">Comuna</option>
                                        <option value="Corregimiento">Corregimiento</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" name="zona" id="zona" required></select>
                                </div>
                            </div> --}}
                        </div>

                    </div>

                    <hr class="my-4">

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('formularios') }}" class="btn btn-secondary">Cancelar</a>
                        <button class="btn btn-success" type="submit">Crear</button>
                    </div>
                </form>
            </div>
        </div>
        </main>
    @endsection

    @section('js-extra')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {

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


                $('#creador').select2({
                    theme: "bootstrap",
                    ajax: {
                        dataType: 'json',
                        url: "{!! route('util.lista_usuarios') !!}",
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

                $('#creador').on('select2:select', function(e) {
                    var data = e.params.data;
                    $('#creador_id').val(data.id);
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

                $("#add_files").click(function() {
                    addFilesField();
                });


                /* create function for filesField and with two select tipo_zona and zona who identify with each other, files type excel and with option for delete files field  */

                function addFilesField(){
                    let container = $("#content_files");
                    let zona = $("#zona");
                    let tipo_zona = $("#tipo_zona");


                    /* <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="file" name="" id="" class="form-control">
                                        <button class="btn btn-danger" title="Quitar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <select name="tipo_zona" id="tipo_zona" class="form-control" required>
                                        <option value="0">Seleccion el tipo de zona</option>
                                        <option value="Comuna">Comuna</option>
                                        <option value="Corregimiento">Corregimiento</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" name="zona" id="zona" required></select>
                                </div>
                            </div> */

                    /* with template string */
                    let template = `
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="file" name="file[]" class="form-control">
                                    <button type="button" class="btn btn-danger" id="delete_field" title="Quitar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>${tipo_zona.find('option:selected').text()}</h5>
                                <input type="hidden" name="tipo_zona[]" value="${tipo_zona.val()}">
                            </div>

                            <div class="col-md-4">
                                <h5>${zona.find('option:selected').text()}</h5>
                                <input type="hidden" name="zona[]" value="${zona.val()}">
                            </div>
                        </div>
                    `;

                    container.append(template);

                    $("#delete_field").click(function(){
                        $(this).parent().parent().parent().remove();
                    });
                }

                $("#tipo_zona").change(function() {
                    if ($(this).val() == 'Corregimiento') {
                        $("#label_zona").html('Vereda');
                    } else {
                        $("#label_zona").html('Barrio');
                    }
                });
            })
        </script>
    @endsection
