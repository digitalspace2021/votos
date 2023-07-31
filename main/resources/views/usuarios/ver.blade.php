@extends('layouts.base')

@section('titulo')
    Ver usuario
@endsection

@section('css-extra')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
        rel="stylesheet" />
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Ver usuario</h1>
    </div>
@endsection

@section('cuerpo')
    <div class="container">
        <div class="row g-5">
            <div class="col-3"></div>
            <div class="col-7">
                <div class="d-flex mb-2 justify-content-center align-items-center">
                    @if ($usuario->foto)
                        <img src="{{ asset('storage/' . $usuario->foto) }}" alt="Foto" class="img-fluid" width="200px">
                    @endif
                </div>
                <div class="row g-3">

                    <div class="col-sm-12">
                        <label for="nombres" class="form-label">Identificacion</label>
                        <input type="number" class="form-control" value="{{ $usuario->identificacion }}" readonly>
                    </div>

                    <div class="col-sm-12">
                        <label for="nombres" class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" value="{{ $usuario->name }}" readonly>
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ $usuario->email }}" readonly>
                    </div>

                    <div class="col-12">
                        <label for="telefono" class="form-label">Rol</label>
                        <input type="text" class="form-control" value="{{ $usuario->rol }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="{{$info->direccion ?? ''}}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">
                            Telefono
                        </label>
                        <input type="phone" name="telefono" id="telefono" class="form-control" value="{{$info->telefono ?? ''}}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="genero" class="form-label">Genero</label>
                        <select class="form-select" name="genero" id="genero" required readonly>
                            <option value="">Seleccione un genero</option>
                            <option value="masculino" {{$info->genero ?? null == 'masculino' ? 'selected' : ''}}>Masculino</option>
                            <option value="femenino" {{$info->genero ?? null == 'femnino' ? 'selected' : ''}}>Femenino</option>
                            <option value="Otro" {{$info->genero ?? null == 'Otro' ? 'selected' : ''}}>Otro</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="referido" class="form-label">Referido</label>
                        <select name="referido" id="" class="form-select" readonly>
                            <option value="">Selecciona el usuario que te asigno</option>
                            @foreach ($users as $item)
                                <option value="{{ $item->id }}"
                                    @php
                                        $referido = $info->referido_id ?? null;
                                    @endphp
                                    @if ($item->id == $referido)
                                        selected
                                    @endif
                                    >{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="tipo_zona" class="form-label">Tipo de ubicacion</label>
                        <select name="tipo_zona" id="tipo_zona" class="form-control" required readonly>
                            <option value="0">Seleccion el tipo de zona</option>
                            @php
                                $tipo_zona = $info->tipo_zona ?? null;
                            @endphp
                            <option value="Comuna" {{$tipo_zona == 'Comuna' ? 'selected' : ''}}>Comuna</option>
                            <option value="Corregimiento" {{$tipo_zona == 'Corregimiento' ? 'selected' : ''}}>Corregimiento</option>
                        </select>
                        <div class="invalid-feedback">
                            Seleccion un tipo de zona valido
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="zona" class="form-label" id="label_zona">Comuna / Corregimiento</label>
                        <select class="form-control" name="zona" id="zona" required readonly></select>
                        <div class="invalid-feedback">
                            Por favor ingresa tu Comuna / Corregimiento.
                        </div>
                    </div>

                    <div class="col-md-12">
                        <textarea name="descripcion" id="" cols="30" rows="5" class="form-control" placeholder="Descripcion del producto" readonly>{{$info->direccion ?? ''}}</textarea>
                    </div>

                </div>

                <hr class="my-4">

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('usuarios') }}" class="btn btn-secondary">Volver</a>
                </div>
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
                    url: '/get_veredas_and_comunas?type=' + zona + '&id=' + '{{ $info->zona ?? '' }}',
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
            })
        </script>
    @endsection