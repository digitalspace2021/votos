@extends('layouts.base')

@section('titulo')
    Crear usuario
@endsection

@section('css-extra')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
        rel="stylesheet" />
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Nuevo usuario</h1>
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

                <form class="needs-validation" method="POST" action="{{ route('usuarios.crear.guardar') }}" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="row g-3">

                        <div class="col-sm-12">
                            <label for="identificacion" class="form-label">Identificacion</label>
                            <input type="number" class="form-control" placeholder="1234567890" name="identificacion" value="{{old('identificacion')}}" required>
                            <div class="invalid-feedback">
                                Este campo es requerido.
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <label for="nombres" class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                placeholder="Nombre completo" value="{{old('nombre')}}" required>
                            <div class="invalid-feedback">
                                Este campo es requerido.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="usuario@mail.com" value="{{old('email')}}" required>
                            <div class="invalid-feedback">
                                Por favor ingresa un Email valido.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder=""
                                required>
                        </div>

                        <div class="col-12">
                            <label for="password" class="form-label">Confirmar Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="" required>
                        </div>

                        <div class="col-12">
                            <label for="rol" class="form-label">Rol</label>
                            <select class="form-control" name="rol" id="rol" required>
                                <option value="">Seleccione un rol</option>
                                <option value="simple">Usuario simple</option>
                                <option value="admin">Administrador</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" id="foto" class="form-control mt-2" accept="image/*">
                            @error('foto')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
        
                        <div class="d-flex justify-content-center">
                            <img src="" alt="" style="display: none; width: 35%;" id="preview_img" class="mt-2">
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('candidatos') }}" class="btn btn-secondary">Cancelar</a>
                        <button class="btn btn-success" type="submit">Crear</button>
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

                let foto = $('#foto');
                let preview = $('#preview_img');

                foto.change(function(){
                    let file = this.files[0];
            
                    if (file == null) {
                        preview.hide();
                        preview.attr('src', '');
                    }else{
                        preview.show();
                        preview.attr('src', URL.createObjectURL(file));
                    }
                })
            })
        </script>
    @endsection
