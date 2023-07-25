@extends('layouts.base')

@section('titulo')
Ver {{$edil->rol}}
@endsection

@section('css-extra')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
    rel="stylesheet" />
@endsection

@section('cabecera')
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">
        Ver {{$edil->rol}}
    </h1>
</div>

@if (session('success') || session('error'))
<div class="alert alert-{{session('success') ? 'success' : 'danger'}} mx-2">
    {{session('success') ?? session('error')}}
</div>
@endif
@endsection

@section('cuerpo')
<div class="container">

    <div class="d-flex justify-content-center align-items-center w-75" style="margin-left: auto; margin-right: auto;">
        <form action="" method="POST" novalidate>
            <input type="hidden" name="id" value="{{$edil->id}}">

            <div class="d-flex mb-2 justify-content-center align-items-center">
                @if ($edil->foto)
                <img src="{{asset('storage/'.$edil->foto)}}" alt="Foto" class="img-fluid" width="200px">
                @endif
            </div>

            <div class="row">
                <div class="col-md-12 mb-2">
                    <label for="identificacion">Identificacion</label>
                    <input type="number" name="identificacion" id="" class="form-control"
                        value="{{$edil->identificacion}}" required disabled>
                    @error('identificacion')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" name="nombres" value="{{$edil->nombres}}" required disabled>
                    @error('nombres')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" value="{{$edil->apellidos}}" required disabled>
                    @error('apellidos')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{$edil->email}}" required disabled>
                    @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="genero" class="form-label">Genero</label>
                    <select name="genero" id="" class="form-select" disabled>
                        <option value="">Selecciona un genero</option>
                        <option value="Hombre" {{$edil->genero=='Hombre' ? 'selected' : '' }}>Hombre</option>
                        <option value="Mujer" {{$edil->genero=='Mujer' ? 'selected' : '' }}>Mujer</option>
                        <option value="Otro" {{$edil->genero=='Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('genero')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="direccion" class="form-label">Direccion</label>
                    <input type="text" class="form-control" name="direccion" value="{{$edil->direccion}}" required disabled>
                    @error('direccion')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="tipo_zona" class="form-label">Tipo de Ubicacion</label>
                        <select name="tipo_zona" id="tipo_zona" class="form-select" required disabled>
                            <option value="0" selected disabled>Seleccione el tipo de zona</option>
                            <option value="Comuna" {{$edil->tipo_zona == 'Comuna' ? 'selected' : ''}}>Comuna</option>
                            <option value="Corregimiento" {{$edil->tipo_zona == 'Corregimiento' ? 'selected' : ''}}>Corregimiento</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="zona" id="label_zona" class="form-label">Comuna/Corregimiento</label>
                        <select name="zona" id="zona" class="form-select" required disabled>
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="puesto_votacion" id="puesto_votacion" class="form-label">Puesto de votacion</label>
                        <input type="text" name="puesto_votacion" id="" class="form-control" value="{{$edil->puesto_votacion}}" disabled required>
                    </div>
                    @error('zona')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="descripcion" class="form-label">Descripcion</label>
                    <textarea name="descripcion" id="" cols="30" rows="5" class="form-control"
                        required disabled>{{$edil->descripcion}}</textarea>
                </div>

                <div class="d-flex justify-content-center">
                    <img src="" alt="" style="display: none; width: 35%;" id="preview_img">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-between">
                    <a href=" {{route('users-edils.index', ['type' => $edil->rol])}}" class="btn btn-danger" id="btnCancel">Cancelar</a>
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
            url: '/get_veredas_and_comunas?type=' + zona + '&id=' + '{{ $edil->zona }}',
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

        $("#tipo_zona").change(function() {
            if ($(this).val() == 'Corregimiento') {
                $("#label_zona").html('Vereda');
            } else {
                $("#label_zona").html('Barrio');
            }
        });
    });
</script>
@endsection