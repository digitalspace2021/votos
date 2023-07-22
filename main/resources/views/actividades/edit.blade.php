@extends('layouts.base')

@section('titulo')
    Actividades
@endsection

@section('css-extra')
    
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Actualizar Actividad</h1>
    </div>
@endsection

@section('cuerpo')
<div class="container">
    <form action="{{route('actividad.update',['id'=>$actividad[0]->id])}}"  enctype="multipart/form-data" id="form_actividad" method="post">
        @csrf
        @method('PUT')
        <div class="alert alert-danger" id="alert" role="alert" style="display: none"></div>
        <div class="mb-3">
          <label for="inputCedula" class="form-label">Cedula</label>
          <input type="number" class="form-control" name="inputCedula" id="inputCedula" aria-describedby="Cedula" value="{{$actividad[0]->cedula}}" readonly>
          <input type="hidden" name="id_user" id="id_user" value="">
        </div>
        <div class="row">
            <div class="mb-3 col">
                <label for="inputNombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="inputNombre" id="inputNombre" value="{{$actividad[0]->nombre}}" readonly>
            </div>
            <div class="mb-3 col">
                <label for="inputDireccion" class="form-label">Direccion</label>
                <input type="text" class="form-control" name="inputDireccion" id="inputDireccion" value="{{$actividad[0]->direccion}}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col">
                <label for="inputTelefono" class="form-label">Telefono</label>
                <input type="text" class="form-control" name="inputTelefono" id="inputTelefono" value="{{$actividad[0]->telefono}}" readonly>
            </div>
            <div class="mb-3 col">
                <label for="inputReferido" class="form-label">Referido</label>
                <input type="text" class="form-control" name="inputReferido" id="inputReferido" value="{{$actividad[0]->referido}}" readonly>
            </div>
        </div>
        
        <hr>
        <br>

        <div class="mb-3">
            <label for="inputFecha" class="form-label">Fecha de la actividad</label>
            <input type="date" class="form-control" name="inputFecha" id="inputFecha" value="{{$actividad[0]->fecha}}" required>
        </div>
        <div class="mb-3">
            <label for="inputTitulo" class="form-label">Nombre de la Actividad</label>
            <input type="text" class="form-control" name="inputTitulo" id="inputTitulo" value="{{$actividad[0]->titulo}}" required>
        </div>
        <div class="mb-3">
          <label for="inputDescript" class="form-label">Describa en que ayudo a participar</label>
          <textarea type="text" class="form-control" id="inputDescript" name="inputDescript" required>{{$actividad[0]->descripcion}}</textarea>
        </div>
        <div class="mb-3">
            <label for="inputEvidencia" class="form-label">Evidencia</label>
            <input type="file" class="form-control" name="inputEvidencia" id="inputEvidencia">
        </div>
        <div class="d-flex justify-content-center">
            <img @if(!empty($actividad[0]->evidencia)) src="{{asset('storage/'.$actividad[0]->evidencia)}}" @else src="" @endif  alt="" style="display: none; width: 35%;" id="preview_img" class="mt-2">
        </div>
        
        
        <div class="mt-5 text-center">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a  href="{{route('actividad.index') }}" class="btn btn-danger">Cancelar</a>
        </div>
      </form>
</div>
@endsection

@section('js-extra')
    <script>
        $(document).ready(async function() {
            let evidencia = $('#inputEvidencia');
            let preview = $('#preview_img');
            let preview_actually = preview.attr('src');
            preview.show();

            evidencia.change(function(){
                let file = this.files[0];
                if (file == null) {
                    if (preview_actually) {
                        preview.attr('src', preview_actually); 
                    } else {
                        preview.hide();
                        preview.attr('src', '');
                    }
                    
                }else{
                    preview.show();
                    preview.attr('src', URL.createObjectURL(file));
                }
            });
        });
    </script>
@endsection