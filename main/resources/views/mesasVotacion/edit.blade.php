@extends('layouts.base')

@section('titulo')
    Mesas de Votacion
@endsection

@section('css-extra')
    <!-- Select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Editar Mesa de Votacion</h1>
    </div>
@endsection

@section('cuerpo')
<div class="container">
    <form action="{{route('mesas.update',['id'=>$mesa[0]->id])}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="inputName" class="form-label">Numero de la mesa de Votacion</label>
          <input type="text" class="form-control" name="inputNumberTable" id="inputNumberTable" aria-describedby="mesa de votacion" value="{{$mesa[0]->numero}}" required>
        </div>
        <div class="mb-3">
          <label for="inputDescript" class="form-label">Descripcion</label>
          <textarea type="text" class="form-control" id="inputDescript" name="inputDescript">{{$mesa[0]->descripcion}}</textarea>
        </div>
        <div class="mb-3">
            <label for="inputName" class="form-label">Puesto de Votacion</label>
            <select class="form-select" aria-label="polling_post" id="selectPolling_post" name="selectPolling_post" required>
                <option value="0">Seleccione la mesa de votacion</option>
                @foreach($puestos as $puesto) 
                <option @if($mesa[0]->id_puesto == $puesto->id) selected @endif value="{{$puesto->id}}">{{$puesto->name}}</option>
                @endforeach
            </select>
        </div>
        
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{route('mesas.index')}}" class="btn btn-danger">Cancelar</a>
        </div>
      </form>
</div>
@endsection

@section('js-extra')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        //inicializar select 2 (funcion de busqueda en los selects)
        $(document).ready(function() {
            $('#selectPolling_post').select2({
                theme: 'bootstrap-5'
            });
        });
    </script>
@endsection