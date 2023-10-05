@extends('layouts.base')

@section('titulo')
Crear votacion
@endsection

@push('custom-css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
    rel="stylesheet" />

<style>
    .select2-container {
        z-index: 100000;
    }
</style>
@endpush

@section('cabecera')
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">Nueva votacion</h1>
</div>

@if (session('success') || session('error'))
<div class="alert alert-{{session('success') ? 'success' : 'danger'}} mx-2">
    {{session('success') ?? session('error')}}
</div>
@endif
@endsection

@section('cuerpo')
<div class="container">

    <div class="d-flex justify-content-center align-items-center w-75"
        style="margin-left: auto; margin-right: auto; flex-direction:column;">
        <form action="" method="POST">
            @csrf
            <div class="row">
                @error('form_id')
                <div class="col-md-12 mb-2">
                    <span class="text-danger">{{$message}}</span>
                </div>
                @enderror
                <input type="hidden" name="form_id" id="form_idform">
                <div class="col-md-6 mb-2">
                    <label for="nombres" class="form-label">Nombres Votante</label>
                    <input type="text" class="form-control" value="@if ($voto->form->nombre == $voto->form->apellido){{$voto->form->nombre}}@else{{$voto->form->nombre}} {{$voto->form->apellido}}@endif" disabled>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="apellidos" class="form-label">Creador Formulario</label>
                    <input type="text" class="form-control" value="{{$voto->form->creador->name}}" id="registrador"
                        disabled>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="email" class="form-label">Fecha de Formulario</label>
                    <input type="email" class="form-control" value="{{$voto->form->created_at}}" id="fecha_creacion"
                        disabled>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="telefono" class="form-label">Comuna</label>
                    <input type="text" class="form-control" value="{{$voto->form->ubicacion()}}" id="ubicacion"
                        disabled>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="direccion" class="form-label">Direccion</label>
                    <input type="text" class="form-control" value="{{$voto->form->direccion}}" id="direccion" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <span class="text-center" style="font-size: 1.5rem; font-weight: 600;">Voto?</span>
                </div>
                {{-- two input radio centers --}}
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <label for="voto">Si</label>
                    <input type="radio" name="voto" id="voto" @if ($voto->voto ==true)
                    checked
                    @endif class="form-check-input" disabled>
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <label for="voto">No</label>
                    <input type="radio" name="voto" id="voto" @if ($voto->voto ==false)
                    checked
                    @endif class="form-check-input" disabled>
                </div>
                @error('voto')
                <div class="col-md-12">
                    <span class="text-danger">{{$message}}</span>
                </div>
                @enderror
            </div>
            <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-between">
                    <a href="{{route('votos.index')}}" class="btn btn-danger" id="btnCancel">Cancelar</a>
                </div>
            </div>
        </form>
    </div>

</div>

@include('components.loading')
@endsection

@push('custom-js')
@endpush