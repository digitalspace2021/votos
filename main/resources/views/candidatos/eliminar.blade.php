@extends('layouts.base')

@section('titulo')
    Eliminar candidato
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Eliminar candidato</h1>
    </div>
@endsection

@section('cuerpo')
    <div class="container">
        <div class="row g-5">
            <div class="col-3"></div>
            <div class="col-7">
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

                    <div class="col-12">
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
                </div>

                <hr class="my-4">

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('candidatos') }}" class="btn btn-secondary">Cancelar</a>
                    <a href="{{ route('candidatos.eliminar.confirmar', $candidato->id) }}"
                        class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
        </main>
    @endsection
