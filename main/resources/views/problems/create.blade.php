@extends('layouts.base')

@section('titulo')
Crear formulario
@endsection

@section('css-extra')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
    rel="stylesheet" />

<style>
    .circle-container {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #ccc;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        font-weight: bold;
    }

    .circle.active {
        background-color: #0b91ffc4;
        color: #fff;
    }


    .line {
        width: 100px;
        height: 2px;
        background-color: #000;
    }
</style>
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
        <form action="{{route('problems.store')}}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @if (Auth::check())
                @if (Auth::user()->hasRole('simple'))
                    <input type="hidden" name="creador" value="{{Auth::user()->id}}">
                @endif
            @endif
            <div class="row" id="step1">
                <div class="col-md-12 mb-2">
                    <label for="creador" class="form-label">Quien lo diligencia</label>
                    <select class="form-control" name="creador" id="creador" required @if (auth()->check())
                        {{Auth::user()->hasRole('administrador') ? '' : 'disabled'}}
                        @endif>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{old('creador')==$user->id ? 'selected' : ''}}
                            @if (auth()->check())
                            {{Auth::user()->id==$user->id ? 'selected' : ''}}
                            @endif
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
                <div class="col-md-12 mb-2">
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
                    <select name="puesto" id="puesto" class="form-select" required>
                        <option value="" disabled>Seleccione un puesto</option>
                        @foreach ($puestos as $puesto)
                        <option value="{{$puesto->puesto_nombre}}" 
                            @if (old('puesto')==$puesto->puesto_nombre)
                                selected
                            @endif
                            puesto_id="{{$puesto->id}}"
                            >{{$puesto->puesto_nombre}}</option>
                        @endforeach
                    </select>
                    @error('puesto')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-6 mb-2">
                    <label for="mesa" class="form-label">Mesa</label>
                    <select name="mesa" id="mesa" class="form-select" required>
                        <option value="" selected disabled>Seleccione una mesa</option>
                    </select>
                    {{-- @error('mesa')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror --}}
                </div>

                <div class="col-md-12 mb-2">
                    <input type="checkbox" name="check_problem" id="check_problem" class="form-check-input"
                        @error('descripcion') checked @enderror>
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

                <div class="col-md-12 mb-2">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control mt-2" accept="image/*">
                    @error('foto')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-center">
                    <img src="" alt="" style="display: none; width: 35%;" id="preview_img" class="mt-2 mb-2">
                </div>

                <div class="col-md-12 mb-2">

                    <label for="">¿Usted desea votar por otro de los candidatos politicos?</label>

                    <div class="d-flex justify-space-around">
                        <div class="col-3">
                            <input type="radio" name="edil" id="edil1" value="1" {{old('edil')==1 ? 'checked' : '' }}>
                            <label for="" class="">Si</label>
                        </div>
                        <div class="col-3">
                            <input type="radio" name="edil" id="edil2" value="0" {{old('edil')==="0" ? 'checked' : ''
                                }}>
                            <label for="">No</label>
                        </div>
                        @error('edil')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="row" id="step2" style="display: none;">

                <div class="col-md-12 mb-2">
                    <label for="" class="form-label">Seleccione el edil al cual dara su apoyo:</label>
                    <div class="col-6">
                        @foreach ($edils as $item)
                        <input type="radio" name="user_edil" value="{{$item->id}}">
                        <label for="" class="form-label">{{$item->nombres}} {{$item->apellidos}}</label>
                        @endforeach
                    </div>

                    @error('user_edil')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-12 mb-2">
                    <label for="" class="form-label">¿Dara este mismo voto al concejo?</label>

                    <div class="d-flex justify-space-around">
                        <div class="col-3">
                            <input type="radio" name="concejo" value="1" {{old('concejo')==1 ? 'checked' : '' }}>
                            <label for="" class="form-label">Si</label>
                        </div>
                        <div class="col-3">
                            <input type="radio" name="concejo" value="0" {{old('concejo')==="0" ? 'checked' : '' }}>
                            <label for="" class="form-label">No</label>
                        </div>
                    </div>
                    @error('concejo')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-12 mb-2">
                    <label for="">¿Apoyara con el mismo voto a los candidatos de alcaldia y gobernación?</label>

                    <div class="d-flex justify-space-around">
                        <div class="col-3">
                            <input type="radio" name="apoyo" id="apoyo1" value="1" {{old('apoyo')==1 ? 'checked' : ''
                                }}>
                            <label for="" class="form-label">Si</label>
                        </div>
                        <div class="col-3">
                            <input type="radio" name="apoyo" id="apoyo2" value="0" {{old('apoyo')==="0" ? 'checked' : ''
                                }}>
                            <label for="" class="form-label">No</label>
                        </div>
                    </div>
                    @error('apoyo')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div id="apGobAl" style="display: none;">
                    <div class="col-12 mb-2">
                        <label for="">¿Dara este mismo voto a la alcaldia?</label>

                        <div class="d-flex justify-space-around">
                            <div class="col-3">
                                <input type="radio" name="alcaldia" id="alcaldia1" value="1" {{old('alcaldia')==1
                                    ? 'checked' : '' }}>
                                <label for="" class="form-label">Si</label>
                            </div>
                            <div class="col-3">
                                <input type="radio" name="alcaldia" id="alcaldia2" value="0" {{old('alcaldia')=="0"
                                    ? 'checked' : '' }}>
                                <label for="" class="form-label">No</label>
                            </div>
                        </div>
                        @error('alcaldia')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-12 mb-2">
                        <label for="">¿Dara este mismo voto a la gobernación?</label>

                        <div class="d-flex justify-space-around">
                            <div class="col-3">
                                <input type="radio" name="gobernacion" id="gobernacion1" value="1"
                                    {{old('gobernacion')==1 ? 'checked' : '' }}>
                                <label for="" class="form-label">Si</label>
                            </div>
                            <div class="col-3">
                                <input type="radio" name="gobernacion" id="gobernacion2" value="0"
                                    {{old('gobernacion')=="0" ? 'checked' : '' }}>
                                <label for="" class="form-label">No</label>
                            </div>
                        </div>
                        @error('gobernacion')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-2">
                    <div class="col-md-12 mb-2">
                        <input type="checkbox" name="cons" id="cons" class="form-check-input">
                        <label for="cons" class="form-check-label">Aceptar Tratamiento de Datos*</label>
                    </div>
                    @error('cons')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-12 mb-2">
                    <div class="circle-container" style="display: none;" id="steps">
                        <div class="circle active">1</div>
                        <div class="line"></div>
                        <div class="circle">2</div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-between">
                    <a href="@if (auth()->check())
                        {{route('problems.index')}}
                        @else
                        {{route('home')}}
                        @endif" class="btn btn-danger" id="btnCancel">Cancelar</a>
                    <button type="button" class="btn btn-primary" id="btnBack" style="display: none">Anterior</button>
                    <button type="submit" class="btn btn-primary" id="btnSave" style="display: none">Guardar</button>
                    <button type="button" class="btn btn-primary" id="btnNext" style="display: none">Siguiente</button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection

@section('js-extra')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    let edil1 = $("#edil1");
    let edil2 = $("#edil2");
    let circle = $(".circle");
    let apoyo1 = $("#apoyo1");
    let apoyo2 = $("#apoyo2");
    $(document).ready(function() {
        $('#creador').select2({
            placeholder: "Seleccione una comuna",
            allowClear: true,
            language: "es",
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

        edil1.click(function(){
            if (this.checked) {
                $("#steps").show();
                $('#btnSave').hide();
                $('#btnNext').show();
            }
        })

        edil2.click(function(){
            if (this.checked) {
                $("#steps").hide();
                $('#btnSave').show();
                $('#btnNext').hide();
            }
        })

        $("#btnNext").click(function(){
            $("#step1").hide();
            $("#step2").show();
            $('#btnBack').show();
            $('#btnNext').hide();
            $('#btnSave').show();
            $("#btnCancel").hide();

            /* class circle */
            circle.removeClass("active");
            circle.eq(0).remove("active");
            circle.eq(1).addClass("active");
        });

        $("#btnBack").click(function(){
            $("#step1").show();
            $("#step2").hide();
            $('#btnBack').hide();
            $('#btnNext').show();
            $('#btnSave').hide();
            $("#btnCancel").show();

            /* class circle */
            circle.removeClass("active");
            circle.eq(1).remove("active");
            circle.eq(0).addClass("active");
        });

        apoyo1.click(function(){
            if (this.checked) {
                $("#apGobAl").show();
            }
        })

        apoyo2.click(function(){
            if (this.checked) {
                $("#apGobAl").hide();
            }
        })

        if (edil1.is(':checked')) {
            $("#steps").show();
            $('#btnSave').hide();
            $('#btnNext').show();
        }

        if (edil2.is(':checked')) {
            $("#steps").hide();
            $('#btnSave').show();
            $('#btnNext').hide();
        }

        if (apoyo1.is(':checked')) {
            $("#apGobAl").show();
        }

        $('#puesto').select2();
        $('#mesa').select2();

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
    });

    let mesas = "{{route('ut.get_mesas')}}";
    $('#puesto').change(function(){
        let puesto_id = $(this).children("option:selected").attr('puesto_id');
        $('#mesa').empty();
        $.ajax({
            url: mesas,
            type: 'GET',
            data: {puesto_id: puesto_id},
            success: function(data){
                $('#mesa').append('<option value="" selected disabled>Seleccione una mesa</option>');
                $.each(data, function(i, item){
                    $('#mesa').append('<option value="'+item.numero_mesa+'">'+item.numero_mesa+'</option>');
                });
            }
        });
    });

</script>
@endsection