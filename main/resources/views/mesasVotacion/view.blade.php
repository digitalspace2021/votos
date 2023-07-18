@extends('layouts.base')

@section('titulo')
    Mesas de Votacion
@endsection

@section('css-extra')
    
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Ver Mesas de Votacion</h1>
    </div>
@endsection

@section('cuerpo')
<div class="container">
    <form action="{{route('mesas.store')}}" method="post">
        @csrf
        <div class="mb-3">
          <label for="inputName" class="form-label">Numero de la mesa de Votacion</label>
          <input type="number" class="form-control" name="inputNumberTable" id="inputNumberTable" aria-describedby="mesa de votacion" readonly>
        </div>
        <div class="mb-3">
          <label for="inputDescript" class="form-label">Descripcion</label>
          <textarea type="text" class="form-control" id="inputDescript" name="inputDescript" readonly></textarea>
        </div>
        <div class="mb-3">
            <label for="inputName" class="form-label">Puesto de Votacion</label>
            <input type="text" class="form-control" readonly>
        </div>
        
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Crear</button>
            <a href="{{route('mesas.index')}}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
</div>
@endsection

@section('js-extra')

@endsection