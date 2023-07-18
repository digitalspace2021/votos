@extends('layouts.base')

@section('titulo')
    Puestos de Votacion
@endsection

@section('css-extra')
    
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Ver Puesto de Votacion</h1>
    </div>
@endsection

@section('cuerpo')
<div class="container">
    <form>
        <div class="mb-3">
          <label for="inputName" class="form-label">Nombre del puesto de Votacion</label>
          <input type="text" class="form-control" name="inputName" id="inputName" aria-describedby="puesto de votacion" value="{{$puestoVotacion[0]->name}}" readonly>
        </div>
        <div class="mb-3">
          <label for="inputDescript" class="form-label">Descripcion</label>
          <textarea type="text" class="form-control" id="inputDescript" name="inputDescript" readonly>{{$puestoVotacion[0]->description}}</textarea>
        </div>
        <div class="mb-3">
            <label for="inputName" class="form-label">Tipo de ubicacion</label>
            <input class="form-control" aria-label="typeZone" id="zone" name="zone" value="{{$puestoVotacion[0]->zone_type}}" readonly>
        </div>
        <div class="mb-3">
            <label for="inputName" class="form-label" id="label_zone">Barrio / Vereda</label>
            <input class="form-control" aria-label="typeZone" id="zone" name="zone" value="{{$puestoVotacion[0]->zona}}" readonly>
        </div>
        
        <div class="text-center">
            <a href="{{route('puestoVotacion.index')}}" class="btn btn-danger">Cancelar</a>
        </div>
      </form>
</div>
@endsection

@section('js-extra')
@endsection