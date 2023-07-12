@extends('layouts.base')

@section('titulo')
Crear formulario
@endsection

@section('css-extra')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
    rel="stylesheet" />
@endsection

@section('cabecera')
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">Nuevos Posibles Votantes</h1>
</div>

@if (session('success') || session('error'))
<div class="alert alert-{{session('success') ? 'success' : 'danger'}} mx-2">
    {{session('success') ?? session('error')}}
</div>
@endif
@endsection

@section('cuerpo')
<div class="container">

    <div class="d-flex justify-content-center align-items-center w-75" style="margin-left: auto; margin-right: auto;">
        <form action="{{route('problems.store')}}" method="POST" novalidate>
            @csrf
            <div class="row">
                <div class="col-md-12 mb-2">
                    <label for="creador" class="form-label">Quien lo diligencia</label>
                    <select class="form-control" name="creador" id="creador" required
                        {{auth()->user()->hasRole('admin') ? '' : 'disabled'}}>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{old('creador')==$user->id ? 'selected' : ''}}
                            {{auth()->user()->id==$user->id ? 'selected' : ''}}
                            >{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('creador')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-12 mb-2">
                    <label for="identificacion">Identificacion</label>
                    <input type="number" name="identificacion" id="" class="form-control"
                        value="{{old('identificacion')}}" required>
                    @error('identificacion')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" name="nombres" value="{{old('nombres')}}" required>
                    @error('nombres')
                    hola
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" value="{{old('apellidos')}}" required>
                    @error('apellidos')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{old('email')}}" required>
                    @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="genero" class="form-label">Genero</label>
                    <select name="genero" id="" class="form-select">
                        <option value="">Selecciona un genero</option>
                        <option value="Hombre" {{old('genero')=='Hombre' ? 'selected' : '' }}>Hombre</option>
                        <option value="Mujer" {{old('genero')=='Mujer' ? 'selected' : '' }}>Mujer</option>
                        <option value="Otro" {{old('genero')=='Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('genero')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="text" class="form-control" name="telefono" value="{{old('telefono')}}" required>
                    @error('telefono')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="direccion" class="form-label">Direccion</label>
                    <input type="text" class="form-control" name="direccion" value="{{old('direccion')}}" required>
                    @error('direccion')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="vinculo" class="form-label">Vinculo</label>
                    <input type="text" class="form-control" name="vinculo" value="{{old('vinculo')}}" required>
                    @error('vinculo')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="puesto" class="form-label">Puesto de votacion</label>
                    <input type="text" class="form-control" name="puesto" value="{{old('puesto')}}" required>
                    @error('puesto')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-12 mb-2">
                    <input type="checkbox" name="check_problem" id="check_problem" class="form-check-input" @error('descripcion') checked @enderror>
                    <label for="check_problem" class="form-check-label">¿Tiene alguna problemática?</label>
                </div>
                <div class="col-md-12" id="desc_problem" style="display: none;">
                    <label for="descripcion">Problematica</label>
                    <textarea name="descripcion" id="" cols="30" rows="5" class="form-control"
                        required>{{old('descripcion')}}</textarea>

                    @error('descripcion')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- <div class="col-md-12">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control mt-2" accept="image/*" required>
                    @error('foto')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div> --}}

                <div class="d-flex justify-content-center">
                    <img src="" alt="" style="display: none; width: 35%;" id="preview_img">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="@if (auth()->check())
                        {{route('problems.index')}}
                        @else
                        {{route('home')}}
                        @endif" class="btn btn-danger">Cancelar</a>
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
            placeholder: "Seleccione una comuna",
            allowClear: true
        });


        let  check = document.getElementById('check_problem');
        let form = document.getElementById('desc_problem');
       
        check.addEventListener('click', function(){
            if (this.checked) {
                form.style.display = 'block'
            }else{
                form.style.display = 'none'
            }
        })

        if (check.checked) {
            form.style.display = 'block'
        }

        /* let foto = $('#foto');
        let preview = $('#preview_img');

        foto.change(function(){
            let file = this.files[0];

            /* if null clear else show */
            if (file == null) {
                preview.hide();
                preview.attr('src', '');
            }else{
                preview.show();
                preview.attr('src', URL.createObjectURL(file));
            }
        }) */
    });
</script>
@endsection