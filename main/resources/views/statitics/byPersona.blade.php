@extends('layouts.base')

@section('titulo')
    Personas
@endsection

@section('css-extra')
    
@endsection

@section('cabecera')
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h5 class="display-6 fw-normal">Seguimiento por Persona</h5>
    <div class="row mt-5">
        <div class="col">
            <form class="row g-3">
                <div class="col-auto">
                    <input type="text" readonly class="form-control-plaintext"  value="Cedula">
                  </div>
                <div class="col-auto">
                  <label for="inputCedula" class="visually-hidden">Identificacion</label>
                  <input type="number" class="form-control" id="inputCedula">
                </div>
                <div class="col-auto">
                  <button type="submit" class="btn btn-primary mb-3">Consultar</button>
                </div>
            </form>

            <div class="container mt-3 mb-2 d-flex justify-content-center align-items-center">
                <div>
                    <img src="{{asset('img/user.png')}}" class="rounded-circle shadow-4 avatar"
                        style="width: 150px;" alt="Avatar" />
                </div>
                
                <div class="mt-4">
                    <div class="row">
                        <div class="col-auto">
                            <label for="">Nombre</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" readonly>
                        </div>
                    </div>
                    
                    <div class="row mt-1">
                        <div class="col-auto">
                            <label for="">Direccion</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" readonly>
                        </div>
                    </div>
    
                    <div class="row mt-1">
                        <div class="col-auto">
                            <label for="">Telefono</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" readonly>
                        </div>
                    </div>
    
                    <div class="row mt-1">
                        <div class="col-auto">
                            <label for="">Referido</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <select class="form-control" name="candidato_id" id="candidato_id"  required>
                    <option value="" selected>Seleccione un candidato</option>
                    @foreach ($candidatos as $candidato)
                        <option value="{{$candidadto[0]->id}}">{{$candidadto[0]->name}}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Este campo es requerido.
                </div>
            </div>
        </div>
        <div class="col">
            <div class="w3-bar w3-black">
                <button class="btn btn-white btn-sm" onclick="viewChart(1)">Actividades</button>
                <button class="btn btn-white btn-sm" onclick="viewChart(2)">Votos</button>
            </div>
        </div>
    </div>  
</div>
@endsection

@section('cuerpo')
<div class="row">
    <div class="col"></div>
    <div class="col">
        <div id="contenedor1"></div>
        <div id="contenedor2" style="display: none;"></div>
    </div>
</div>

@endsection

@section('js-extra')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
@endsection