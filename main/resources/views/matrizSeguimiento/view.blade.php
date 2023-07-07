 @php
     print_r($seguimientos[0]->formulario_id);
 @endphp
@extends('layouts.base')

@section('titulo')
    Matriz de Seguimiento
@endsection

@section('css-extra')
    
@endsection

@section('cabecera')
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">Ver Matriz de Seguimiento</h1>
</div>
@endsection

@section('cuerpo')
    <!-- Form -->
    <form >
        @csrf
        <div class="row">
            <div class="col">
                <label  for="exampleFormControlInput1">Celula</label>
                <input type="number" class="form-control" id="ID" name="ID" value="{{$seguimientos[0]->identificacion}}" placeholder="123456789" readonly>
              </div>
              <div class="col">
                  <label  for="exampleFormControlInput1">Nombre</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{$seguimientos[0]->usuario}}" placeholder="Su nombre" readonly>
              </div>
        </div>
        <div class="row">
            <div class="col">
                <label  for="exampleFormControlInput1">Direccion</label>
                <input type="text" class="form-control" id="address" name="address" value="{{$seguimientos[0]->direccion}}" placeholder="Su direccion" readonly>
            </div>
            <div class="col">
                <label  for="exampleFormControlInput1">Telefono</label>
                <input type="number" class="form-control" id="phone" name="phone" value="{{$seguimientos[0]->telefono}}" placeholder="5555555" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label  for="exampleFormControlInput1">Referido</label>
                <input type="text" class="form-control" id="referred" value="{{$seguimientos[0]->referido}}" name="referred" placeholder="" readonly>
            </div>
        </div>

        <!-- encuesta -->
        <div class="mt-5 mb-5 p-3 bg-light">
            <div class="row">
                <div class="col">
                    <label  for="">Se le enseño a votar?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta1" value="1" class="grupo1" @if ($seguimientos[0]->respuesta_uno == 1) checked @endif disabled>
                        <label for="">No</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta1" value="0" class="grupo1" @if ($seguimientos[0]->respuesta_uno == 0) checked @endif disabled>
                      </div>
                </div>
        
                <div class="col">
                    <label  for="">Se le pego publicidad?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta2" value="1" class="grupo2" @if ($seguimientos[0]->respuesta_dos == 1) checked @endif disabled>
                        <label for="">No</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta2" value="0" class="grupo2" @if ($seguimientos[0]->respuesta_dos == 0) checked @endif disabled>
                      </div>
                </div>
            </div>
    
            <div class="row mt-2">
                <div class="col">
                    <label  for="">Tiene carro o moto para ir a votar?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta3" value="1" class="grupo3" @if ($seguimientos[0]->respuesta_tres == 1) checked @endif disabled>
                        <label for="">No</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta3" value="0" class="grupo3" @if ($seguimientos[0]->respuesta_tres == 0) checked @endif disabled>
                      </div>
                </div>
        
                <div class="col">
                    <label class="font-weight-bold" for="">Se le ha echo seguimiento constante?</label>
                    <div >
                        <label for="">Si</label>
                        <input id="pregunta4" type="checkbox" aria-label="Checkbox for following text input" name="pregunta4" value="1" class="grupo4" @if ($seguimientos[0]->respuesta_cuatro == 1) checked @endif disabled>
                        <label for="">No</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta4" value="0" class="grupo4" @if ($seguimientos[0]->respuesta_cuatro == 0) checked @endif disabled>
                    </div>
                    <div class="form-group mt-2">
                        <label  for="">En qué fecha se le ha llamado?</label><br>
                        <label for="">Fechas Seleccionadas: {{$seguimientos[0]->fechas_cuatro}}</label>
                    </div>
                </div>
                
            </div>
    
            <div class="row mt-2">
                <div class="col">
                    <label  for="">Se le ha visitado?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input id="pregunta5" type="checkbox" aria-label="Checkbox for following text input" name="pregunta5" value="1" class="grupo5" @if ($seguimientos[0]->respuesta_cinco == 1) checked @endif disabled>
                        <label for="">No</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta5" value="0" class="grupo5" @if ($seguimientos[0]->respuesta_cinco == 0) checked @endif disabled>
                    </div>
                    <div class="form-group mt-2" id="visit5" @if ($seguimientos[0]->respuesta_cinco == 0) style="display: none;" @endif>
                        <label  for="">En que fecha se le ha visitado?</label><br>
                        <label for="">Fechas Seleccionadas: {{$seguimientos[0]->fechas_cuatro}}</label>
                    </div>
                </div>
        
                <div class="col">
                    <label for=""> El lugar de votacion es cerca a su casa?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta6" value="1" class="grupo6" @if ($seguimientos[0]->respuesta_seis == 1) checked @endif disabled>
                        <label for="">No</label>
                        <input type="checkbox" aria-label="Checkbox for following text input" name="pregunta6" value="0" class="grupo6" @if ($seguimientos[0]->respuesta_seis == 0) checked @endif disabled>
                      </div>
                </div>
            </div>
        </div>

        <a href="{{route('matriz')}}" class="btn btn-danger">Volver</a>
      </form>
    <!-- end form -->
@endsection

@section('js-extra')
@endsection