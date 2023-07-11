@extends('layouts.base')

@section('titulo')
Ver Formulario
@endsection

@section('css-extra')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
    rel="stylesheet" />
@endsection

@section('cabecera')
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">Ver Formulario</h1>
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
                    <input type="text" name="identificacion" id="" class="form-control" value="{{$formulario->propietario_nombre}}" required disabled>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="creador" class="form-label">Candidato</label>
                    <input type="text" name="identificacion" id="" class="form-control" value="{{$formulario->candidato_nombre}}" required disabled>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="identificacion">Identificacion</label>
                    <input type="number" name="identificacion" id="" class="form-control" value="{{$formulario->identificacion}}" required disabled>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" name="nombres" value="{{$formulario->nombre}}" required disabled>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" value="{{$formulario->apellido}}" required disabled>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{$formulario->email}}" required disabled>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="genero" class="form-label">Genero</label>
                    <select name="genero" id="" class="form-select" disabled>
                        <option value="">Selecciona un genero</option>
                        <option value="Hombre" {{$formulario->genero == 'Hombre' ? 'selected' : ''}}>Hombre</option>
                        <option value="Mujer" {{$formulario->genero == 'Mujer' ? 'selected' : ''}}>Mujer</option>
                        <option value="Otro" {{$formulario->genero == 'Otro' ? 'selected' : ''}}>Otro</option>
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="text" class="form-control" name="telefono" value="{{$formulario->telefono}}" required disabled>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="direccion" class="form-label">Direccion</label>
                    <input type="text" class="form-control" name="direccion" value="{{$formulario->direccion}}" required disabled>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="puesto" class="form-label">Puesto de votacion</label>
                    <input type="number" class="form-control" name="puesto" value="{{$formulario->puesto_votacion}}" required disabled>
                </div>
                <div class="col-md-12" id="desc_problem">
                    <label for="descripcion">Problematica</label>
                    <textarea name="descripcion" id="" cols="30" rows="5" class="form-control"
                        required disabled>{{$formulario->mensaje}}</textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-between">
                    <a href="{{route('pre-formularios')}}" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection