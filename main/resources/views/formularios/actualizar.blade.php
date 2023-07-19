@extends('layouts.base')

@section('titulo')
    Actualizar formulario
@endsection

@section('css-extra')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
        rel="stylesheet" />
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Actualizar formulario</h1>
    </div>
@endsection


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

                <form class="needs-validation" method="POST"
                    action="{{ route('formularios.actualizar.guardar', $formulario->id) }}" novalidate>
                    @csrf
                    <input type="hidden" name="creador_id" id="creador_id" value="{{ $formulario->propietario_id }}">
                    <input type="hidden" name="candidato_id" id="candidato_id" value="{{ $formulario->candidato_id }}">

                    <div class="row g-3">

                        <div class="col-12">
                            <label for="candidato" class="form-label">Candidato</label>
                            <select name="candidato" class="form-control" name="candidato" id="candidato" required>
                                <option value="{{ $formulario->candidato_id }}">{{ $formulario->candidato_nombre }}
                                </option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="creador" class="form-label">Quien lo diligencia</label>
                            <select name="creador" class="form-control" name="creador" id="creador" required>
                                <option value="{{ $formulario->propietario_id }}">{{ $formulario->propietario_nombre }}
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                Este campo es requerido.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="nombres" class="form-label">Nombre(s)</label>
                            <input name="nombres" type="text" class="form-control" value="{{ $formulario->nombre }}">
                        </div>

                        <div class="col-sm-6">
                            <label for="apellidos" class="form-label">Apellido(s)</label>
                            <input name="apellidos" type="text" class="form-control" value="{{ $formulario->apellido }}">
                        </div>

                        <div class="col-sm-6">
                            <label for="identificacion" class="form-label">Cedula</label>
                            <input name="identificacion" type="text" class="form-control"
                                value="{{ $formulario->identificacion }}">
                        </div>

                        <div class="col-6">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" value="{{ $formulario->email }}">
                        </div>

                        <div class="col-6">
                            <label for="telefono" class="form-label">Telefono</label>
                            <input name="telefono" type="text" class="form-control" value="{{ $formulario->telefono }}">
                        </div>

                        <div class="col-6">
                            <label for="genero" class="form-label">Sexo</label>
                            <select name="genero" id="genero" class="form-control" value="{{ $formulario->genero }}"
                                required>

                                <option value="">Selecciona genero</option>
                                <option value="Hombre" {{ $formulario->genero == 'Hombre' ? 'selected' : '' }}>Hombre
                                </option>
                                <option value="Mujer" {{ $formulario->genero == 'Mujer' ? 'selected' : '' }}>Mujer
                                </option>
                                <option value="Otro" {{ $formulario->genero == 'Otro' ? 'selected' : '' }}>Otro</option>

                            </select>
                            <div class="invalid-feedback">
                                Por favor ingresa tu sexo.
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="direccion" class="form-label">Direccion</label>
                            <input name="direccion" type="text" class="form-control"
                                value="{{ $formulario->direccion }}">
                        </div>

                        <div class="col-6">
                            <label for="tipo_zona" class="form-label">Tipo de ubicacion</label>
                            <select name="tipo_zona" id="tipo_zona" class="form-control" required>
                                <option value="0">Seleccion el tipo de zona</option>
                                <option value="Comuna" {{ $formulario->tipo_zona == 'Comuna' ? 'selected' : '' }}>Comuna
                                </option>
                                <option value="Corregimiento" {{ $formulario->tipo_zona == 'Corregimiento' ? 'selected' : '' }}>Corregimiento
                                </option>
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

                        <div class="col-6">
                            <label for="puesto_votacion" class="form-label">Puesto de votacion</label>
                            <select name="puesto_votacion" id="puesto" class="form-select" required>
                                <option value="" selected disabled>Seleccione un puesto</option>
                                @php
                                    $status = false;
                                @endphp
                                @foreach ($puestos as $puesto)
                                <option value="{{$puesto->puesto_nombre}}" 
                                    @if ($puesto->puesto_nombre == $formulario->puesto_votacion)
                                        @php
                                            $status = true;
                                        @endphp
                                        selected
                                    @endif
                                    >{{$puesto->puesto_nombre}}</option>
                                @endforeach

                                @if ($status == false)
                                    <option value="{{$formulario->puesto_votacion}}" selected>{{$formulario->puesto_votacion}}</option>
                                @endif

                            </select>
                        </div>

                        <div class="col-12">
                            <label for="mensaje" class="form-label">Problematica</label>
                            <textarea name="mensaje" ea class="form-control" cols="30" rows="10">{{ $formulario->mensaje }}</textarea>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('formularios') }}" class="btn btn-secondary">Cancelar</a>
                        <button class="btn btn-success" type="submit">Actualizar</button>
                    </div>

                </form>
            </div>
        </div>
        </main>
    @endsection

    @section('js-extra')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(async function() {

                var zona = $('#tipo_zona').val()

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

                await $.ajax({
                    type: 'GET',
                    url: '/get_veredas_and_comunas?type=' + zona + '&id=' + '{{ $formulario->zona }}',
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
                }).then(function(data) {
                    var option = new Option(data[0].text, data[0].id, true, true);
                    $('#zona').append(option).trigger('change');
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
                
                $('#creador').val('{{ $formulario->propietario_id }}').trigger('change');

                $('#creador').on('select2:select', function(e) {
                    var data = e.params.data;
                    $('#creador_id').val(data.id);
                });

                $('#candidato').select2({
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
                $('#candidato').val('{{ $formulario->candidato_id }}').trigger('change');

                $('#candidato').on('select2:select', function(e) {
                    var data = e.params.data;
                    $('#candidato_id').val(data.id);
                });

                (() => {
                    'use strict'

                    const forms = document.querySelectorAll('.needs-validation')
                    Array.from(forms).forEach(form => {
                        form.addEventListener('submit', event => {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
                })()


                $("#tipo_zona").change(function() {
                    if ($(this).val() == 'Corregimiento') {
                        $("#label_zona").html('Vereda');
                    } else {
                        $("#label_zona").html('Barrionot');
                    }
                });

                $('#puesto').select2();
            })
        </script>
    @endsection
