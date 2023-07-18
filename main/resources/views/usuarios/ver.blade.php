@extends('layouts.base')

@section('titulo')
    Ver usuario
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

                </div>

                <hr class="my-4">

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('usuarios') }}" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>
        </main>
    @endsection
