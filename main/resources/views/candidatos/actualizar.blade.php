@extends('layouts.base')

@section('titulo')
    Actualizar candidato
@endsection

@section('css-extra')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
        rel="stylesheet" />
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Actualizar candidato</h1>
    </div>
@endsection

@section('cuerpo')
    <div class="container">
        <div class="row g-5">
            <div class="col-3"></div>
            <div class="col-7">
                <form class="needs-validation" method="POST"
                    action="{{ route('candidatos.actualizar.guardar', $candidato->id) }}" novalidate>
                    @csrf

                    <div class="row g-3">

                        <div class="col-sm-12">
                            <label for="nombres" class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" value="{{ $candidato->name }}" id="name"
                                name="name" placeholder="Nombre completo" value="" required>
                            <div class="invalid-feedback">
                                Este campo es requerido.
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <label for="nombres" class="form-label">Cedula</label>
                            <input type="text" class="form-control" value="{{ $candidato->identifcacion }}"
                                id="identifcacion" name="identifcacion" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Este campo es requerido.
                            </div>
                        </div>


                        <div class="col-sm-12">
                            <label for="nombres" class="form-label">Dirección</label>
                            <input type="text" class="form-control" value="{{ $candidato->direccion }}" id="direccion"
                                name="direccion" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Este campo es requerido.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="telefono" class="form-label">Telefono</label>
                            <input type="text" class="form-control" value="{{ $candidato->telefono }}" id="telefono"
                                name="telefono" placeholder="+57 321-123-1122" required>
                            <div class="invalid-feedback">
                                Por favor ingresa tu numero telefonico.
                            </div>
                        </div>

                        <div class="col-12 mb-2">
                            <label for="cargo_id" class="form-label">Cargo</label>
                            <select class="form-control" name="cargo_id" value="{{ $candidato->cargo_id }}" id="cargo_id"
                                required>
                                @foreach ($cargos as $item)
                                    <option <?php if ($candidato->cargo_id == $item->id) {
                                        echo 'selected';
                                    } ?> value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') ?? $candidato->fecha_nacimiento}}"
                                required>
                            @error('fecha_nacimiento')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('candidatos') }}" class="btn btn-secondary">Cancelar</a>
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
