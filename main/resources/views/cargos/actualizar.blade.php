@extends('layouts.base')

@section('titulo')
    Actualizar cargo
@endsection

@section('css-extra')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
        rel="stylesheet" />
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Actualizar cargo</h1>
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

                <form class="needs-validation" method="POST" action="{{ route('cargos.actualizar.guardar', $cargo->id) }}"
                    novalidate>
                    @csrf

                    <div class="row g-3">

                        <div class="col-sm-12">
                            <label for="nombres" class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nombre completo" value="{{ $cargo->name }}" required>
                            <div class="invalid-feedback">
                                Este campo es requerido.
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <label for="nombres" class="form-label">Descripcion</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion"
                                placeholder="Decripcion" value="{{ $cargo->descripcion }}" required>
                            <div class="invalid-feedback">
                                Este campo es requerido.
                            </div>
                        </div>


                    </div>

                    <hr class="my-4">

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('cargos') }}" class="btn btn-secondary">Cancelar</a>
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
            $(document).ready(function() {
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
            })
        </script>
    @endsection
