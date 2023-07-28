
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
                    <label  for="">El dia de las elecciones tiene trasporte?</label>
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
                    <div class="form-group mt-2 mb-2">
                        <label  for="">En qué fecha se le ha llamado?</label><br>
                        <label for="">Fechas Seleccionadas: {{$seguimientos[0]->fechas_cuatro}}</label>
                    </div>
                    @php $observacionesCall = explode(',', $seguimientos[0]->obs_cuatro); $j=0; @endphp
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        @foreach ($observacionesCall as $obsCall)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#obsCall{{$j}}" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                Observacion
                              </button>
                            </h2>
                            <div id="obsCall{{$j}}" class="accordion-collapse collapse show">
                              <div class="accordion-body">
                                {{$obsCall}}
                              </div>
                            </div>
                          </div>
                          @php $j++;  @endphp
                        @endforeach
                        
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
                    <div class="form-group mt-2 mb-2" id="visit5" @if ($seguimientos[0]->respuesta_cinco == 0) style="display: none;" @endif>
                        <label  for="">En que fecha se le ha visitado?</label><br>
                        <label for="">Fechas Seleccionadas: {{$seguimientos[0]->fechas_cuatro}}</label>
                    </div>
                    @php $observacionesVisit = explode(',', $seguimientos[0]->obs_cinco); $i=0; @endphp
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        @foreach ($observacionesVisit as $obsVisit)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#obsVisit{{$i}}" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                Observacion
                              </button>
                            </h2>
                            <div id="obsVisit{{$i}}" class="accordion-collapse collapse show">
                              <div class="accordion-body">
                                {{$obsVisit}}
                              </div>
                            </div>
                          </div>
                          @php $i++;  @endphp
                        @endforeach
                        
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

            <div class="row mt-2">
                <div class="col">
                    <label for="">Ha participado en actividades de forma frecuente?</label>
                    <div class="input-group-text">
                        <label for="">Si</label>
                        <input id="pregunta7" type="checkbox" aria-label="Checkbox for following text input" name="pregunta7" value="1" class="grupo7" @if ($seguimientos[0]->respuesta_siete == 1) checked @endif disabled> 
                        <label for="">No</label>
                        <input id="pregunta7Not" type="checkbox" aria-label="Checkbox for following text input" name="pregunta7" value="0" class="grupo7" @if ($seguimientos[0]->respuesta_siete == 0) checked @endif disabled>
                    </div>
                    <div class="form-group mt-2" @if ($seguimientos[0]->respuesta_siete == 0) style="display: none;" @endif>
                        <label  for="">En qué fecha ha participado?</label><br>
                        <label for="">Fechas Seleccionadas: {{$seguimientos[0]->fechas_siete}}</label>
                    </div>

                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{route('matriz')}}" class="btn btn-danger">Cancelar</a>
        </div>
      </form>
    <!-- end form -->
@endsection

@section('js-extra')
@endsection