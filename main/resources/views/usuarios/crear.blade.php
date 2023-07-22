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
                                <option value="simple" {{old('rol') == 'simple' ? 'selected' : ''}}>Usuario simple</option>
                                <option value="admin" {{old('rol' == 'admin' ? 'selected' : '')}}>Administrador</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="direccion" class="form-label">Direccion</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" value="{{old('direccion')}}">
                        </div>
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">
                                Telefono
                            </label>
                            <input type="phone" name="telefono" id="telefono" class="form-control" value="{{old('telefono')}}">
                        </div>
                        <div class="col-md-6">
                            <label for="genero" class="form-label">Genero</label>
                            <select class="form-select" name="genero" id="genero" required>
                                <option value="">Seleccione un genero</option>
                                <option value="masculino" {{old('genero') == 'masculino' ? 'selected' : ''}}>Masculino</option>
                                <option value="femenino" {{old('genero') == 'femenino' ? 'selected' : ''}}>Femenino</option>
                                <option value="Otro" {{old('genero') == 'otro' ? 'selected' : ''}}>Otro</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="referido" class="form-label">Referido</label>
                            <select name="referido" id="" class="form-select">
                                <option value="">Selecciona el usuario que te asigno</option>
                                @foreach ($users as $item)
                                    <option value="{{ $item->id }}"
                                        @if (old('referido') == $item->id)
                                            selected
                                        @endif
                                        >{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-6">
                            <label for="tipo_zona" class="form-label">Tipo de ubicacion</label>
                            <select name="tipo_zona" id="tipo_zona" class="form-control" required>
                                <option value="0">Seleccion el tipo de zona</option>
                                <option value="Comuna"
                                    @if (old('tipo_zona') == 'Comuna')
                                        selected
                                    @endif>Comuna</option>
                                <option value="Corregimiento"
                                    @if (old('tipo_zona') == 'Corregimiento')
                                        selected
                                    @endif>Corregimiento</option>
                            </select>
                            <div class="invalid-feedback">
                                Seleccion un tipo de zona valido
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="zona" class="form-label" id="label_zona">Comuna / Corregimiento</label>
                            <select class="form-control" name="zona" id="zona" required></select>
                            {{-- <input type="text" class="form-control" id="zona" name="zona"
                                placeholder="Comuna" required> --}}
                            <div class="invalid-feedback">
                                Por favor ingresa tu Comuna / Corregimiento.
                            </div>
                        </div>

                        <div class="col-md-12">
                            <textarea name="descripcion" id="" cols="30" rows="5" class="form-control" placeholder="Descripcion del producto">{{old('descripcion')}}</textarea>
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
                });

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

                $('#zona').on('select2:select', function(e) {
                    var data = e.params.data;
                    $('#zona').val(data.id);
                });

                $("#tipo_zona").change(function() {
                    if ($(this).val() == 'Corregimiento') {
                        $("#label_zona").html('Vereda');
                    } else {
                        $("#label_zona").html('Barrio');
                    }
                });
            })
        </script>
    @endsection
