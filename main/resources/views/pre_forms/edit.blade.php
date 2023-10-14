@extends('layouts.base')

@section('titulo')
Editar Formulario
@endsection

@section('css-extra')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
    rel="stylesheet" />
@endsection

@section('cabecera')
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">Editar Fomulario</h1>
</div>

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
@endsection

@section('cuerpo')
<div class="container">

    <div class="d-flex justify-content-center align-items-center w-75" style="margin-left: auto; margin-right: auto;">
        <form action="{{route('pre-formularios.update', $pre_formulario->id)}}" method="POST" id="pre_form_update" novalidate>
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-12 mb-2">
                    <label for="creador" class="form-label">Quien lo diligencia</label>
                    <select class="form-control" name="creador" id="creador" required>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if ($user->id == $pre_formulario->propietario_id) selected
                            @endif>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('creador')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-12 mb-2">
                    <label for="candidatos" class="form-label">Candidato</label>
                    <select name="candidatos[]" id="candidatos" class="form-select" aria-multiselectable="true" multiple>
                        <option value="" disabled>Selecciona un candidato</option>
                        @foreach ($candidatos as $candidato)
                            <option value="{{ $candidato->id }}"
                                {{ in_array($candidato->id, $formulario_candidatos) ? 'selected' : '' }}
                                >{{ $candidato->name }}</option>
                        @endforeach
                    </select>

                    @error('candidatos')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-12 mb-2">
                    <label for="identificacion">Identificacion</label>
                    <input type="number" name="identificacion" id="" class="form-control"
                        value="{{$pre_formulario->identificacion}}" required>
                    @error('identificacion')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" name="nombres" value="{{$pre_formulario->nombre}}" required>
                    @error('nombres')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" value="{{$pre_formulario->apellido}}"
                        required>
                    @error('apellidos')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{$pre_formulario->email}}" required>
                    @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="genero" class="form-label">Genero</label>
                    <select name="genero" id="" class="form-select">
                        <option value="">Selecciona un genero</option>
                        <option value="Hombre" {{$pre_formulario->genero == 'Hombre' ? 'selected' : ''}}>Hombre</option>
                        <option value="Mujer" {{$pre_formulario->genero == 'Mujer' ? 'selected' : ''}}>Mujer</option>
                        <option value="Otro" {{$pre_formulario->genero == 'Otro' ? 'selected' : ''}}>Otro</option>
                    </select>
                    @error('genero')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="text" class="form-control" name="telefono" value="{{$pre_formulario->telefono}}"
                        required>
                    @error('telefono')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="direccion" class="form-label">Direccion</label>
                    <input type="text" class="form-control" name="direccion" value="{{$pre_formulario->direccion}}"
                        required>
                    @error('direccion')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="tipo_zona" class="form-label">Tipo de ubicacion</label>
                    <select name="tipo_zona" id="tipo_zona" class="form-control" required>
                        <option value="0">Seleccion el tipo de zona</option>
                        <option value="Comuna" {{ $pre_formulario->tipo_zona == 'Comuna' ? 'selected' : '' }}>Comuna
                        </option>
                        <option value="Corregimiento" {{ $pre_formulario->tipo_zona == 'Corregimiento' ? 'selected' : ''
                            }}>Corregimiento
                        </option>
                    </select>
                    @error('tipo_zona')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="zona" class="form-label">Comuna / Corregimiento</label>
                    <select class="form-control" name="zona" id="zona" required></select>
                    @error('zona')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="puesto" class="form-label">Puesto de votacion</label>
                    <select name="puesto" id="puesto" class="form-select" required>
                        <option value="" selected disabled>Seleccione un puesto</option>
                        @php
                            $status = false;
                        @endphp
                        @foreach ($puestos as $puesto)
                        <option value="{{$puesto->id}}" 
                            @if ($puesto->id == $pre_formulario->puesto_votacion)
                                selected
                                @php
                                    $status = true;
                                @endphp
                            @endif
                            puesto_id="{{$puesto->id}}"
                            >{{$puesto->puesto_nombre}}</option>
                        @endforeach
                        @if (!$status)
                            <option value="{{$pre_formulario->puesto_votacion}}" selected>Cambiar - {{$pre_formulario->puesto_votacion}}</option>
                        @endif
                    </select>
                    @error('puesto')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-6 mb-2">
                    <label for="mesa" class="form-label">Mesa</label>
                    <select name="mesa" id="mesa" class="form-select">
                        <option value="" selected disabled>Seleccione una mesa</option>
                    </select>
                    {{-- @error('mesa')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror --}}
                </div>

                <div class="col-md-12" id="desc_pre_formulario">
                    <label for="descripcion">Problematica</label>
                    <textarea name="descripcion" id="" cols="30" rows="5" class="form-control"
                        required>{{$pre_formulario->mensaje}}</textarea>

                    @error('descripcion')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <button type="submit" class="btn btn-primary" name="type_action" value="app-upd">Actualizar y Aprobar</button>
                    <a href="{{route('pre-formularios')}}" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection

@section('js-extra')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(async function() {
        let mesas = "{{route('ut.get_mesas')}}";
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
                    url: '/get_veredas_and_comunas?type=' + zona + '&id=' + '{{ $pre_formulario->zona }}',
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
                width: '100%',
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

        $('#candidatos').select2({
            multiple: true,
        })

        $('#puesto').select2();
        $('#mesa').select2();

        function getMesas(){
            let puesto_id = $(this).children("option:selected").attr('puesto_id');
            $('#mesa').empty();
            $.ajax({
                url: mesas,
                type: 'GET',
                data: {puesto_id: puesto_id},
                success: function(data){
                    $('#mesa').append('<option value="" selected disabled>Seleccione una mesa</option>');
                    $.each(data, function(i, item){
                        $('#mesa').append(`
                            <option value="${item.numero_mesa}"
                                ${item.numero_mesa == '{{$pre_formulario->mesa}}' ? 'selected' : ''}>${item.numero_mesa}</option>
                        `);
                    });
                }
            });
        }
        
        $('#puesto').change(function(){
            getMesas.call(this);
        });

        getMesas.call($('#puesto'));
    });
</script>
@endsection