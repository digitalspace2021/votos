@extends('layouts.base')

@section('titulo')
    Ver cargo
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Ver cargo</h1>
    </div>
@endsection

@section('cuerpo')
    <div class="container">
        <div class="row g-5">
            <div class="col-3"></div>
            <div class="col-7">
                <div class="row g-3">

                    <div class="col-sm-12">
                        <label for="nombres" class="form-label">Nombre</label>
                        <input type="text" class="form-control" value="{{ $cargo->name }}" readonly>
                    </div>

                    <div class="col-sm-12">
                        <label for="nombres" class="form-label">Descripcion</label>
                        <input type="text" class="form-control" value="{{ $cargo->descripcion }}" readonly>
                    </div>

                </div>

                <hr class="my-4">

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('cargos') }}" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>
        </main>
    @endsection
