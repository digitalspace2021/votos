@extends('layouts.base')

@section('titulo')
Posibles Votantes
@endsection

@section('css-extra')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
    rel="stylesheet" />
@endsection

@section('cabecera')
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">Ver Posibles Votantes</h1>
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
        <form>
            <div class="row">
                <div class="col-md-12 mb-2">
                    <label for="creador" class="form-label">Quien lo diligencia</label>
                    <select class="form-control" name="creador" id="creador" required disabled>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if ($user->id == $problem->propietario_id) selected @endif>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="identificacion">Identificacion</label>
                    <input type="number" name="identificacion" id="" class="form-control" value="{{$problem->identificacion}}" required disabled>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" name="nombres" value="{{$problem->nombre}}" required disabled>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" value="{{$problem->apellido}}" required disabled>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{$problem->email}}" required disabled>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="genero" class="form-label">Genero</label>
                    <select name="genero" id="" class="form-select" disabled>
                        <option value="">Selecciona un genero</option>
                        <option value="Hombre" {{$problem->genero == 'Hombre' ? 'selected' : ''}}>Hombre</option>
                        <option value="Mujer" {{$problem->genero == 'Mujer' ? 'selected' : ''}}>Mujer</option>
                        <option value="Otro" {{$problem->genero == 'Otro' ? 'selected' : ''}}>Otro</option>
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="text" class="form-control" name="telefono" value="{{$problem->telefono}}" required disabled>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="direccion" class="form-label">Direccion</label>
                    <input type="text" class="form-control" name="direccion" value="{{$problem->direccion}}" required disabled>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="vinculo" class="form-label">Vinculo</label>
                    <input type="text" class="form-control" name="vinculo" value="{{$problem->vinculo}}" required disabled>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="puesto" class="form-label">Puesto de votacion</label>
                    <input type="text" class="form-control" name="puesto" value="{{$problem->puesto_votacion}}" required disabled>
                </div>
                <div class="col-md-12 mb-2">
                    <input type="checkbox" name="check_problem" id="check_problem" class="form-check-input" @if ($problem->mensaje) checked @endif disabled>
                    <label for="check_problem" class="form-check-label">¿Tiene alguna problemática?</label>
                </div>
                <div class="col-md-12" id="desc_problem" style="display: none;">
                    <label for="descripcion">Problematica</label>
                    <textarea name="descripcion" id="" cols="30" rows="5" class="form-control"
                        required disabled>{{$problem->mensaje}}</textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-between">
                    <a href="{{route('problems.index')}}" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection

@section('js-extra')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
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

        let  check = document.getElementById('check_problem');
        let form = document.getElementById('desc_problem');

        if (check.checked) {
            form.style.display = 'block'
        }
    });
</script>
@endsection