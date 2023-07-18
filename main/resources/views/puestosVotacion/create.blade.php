
@extends('layouts.base')

@section('titulo')
    Puestos de Votacion
@endsection

@section('css-extra')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
        rel="stylesheet" />
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Crear Puesto de Votacion</h1>
    </div>
@endsection

@section('cuerpo')
<div class="container">
    <form action="{{route('puestoVotacion.store')}}" method="post">
        @csrf
        <div class="mb-3">
          <label for="inputName" class="form-label">Nombre del puesto de Votacion</label>
          <input type="text" class="form-control" name="inputName" id="inputName" aria-describedby="puesto de votacion">
        </div>
        <div class="mb-3">
          <label for="inputDescript" class="form-label">Descripcion</label>
          <textarea type="text" class="form-control" id="inputDescript" name="inputDescript"></textarea>
        </div>
        <div class="mb-3">
            <label for="inputName" class="form-label">Tipo de ubicacion</label>
            <select class="form-select" aria-label="typeZone" id="selectTypeZone" name="selectTypeZone" required>
                <option value="0">Seleccion el tipo de zona</option>
                <option value="Comuna">Comuna</option>
                <option value="Corregimiento">Corregimiento</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="inputName" class="form-label" id="label_zone">Barrio / Vereda</label>
            <select class="form-select" aria-label="typeZone" id="zone" name="zone">
            </select>
        </div>
        
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Crear</button>
            <a href="" class="btn btn-danger">Cancelar</a>
        </div>
      </form>
</div>
@endsection

@section('js-extra')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $( document ).ready(function() {
        //get neighborhoods and sidewalks as appropriate
        $('#zone').select2({
                    theme: "bootstrap",
                    ajax: {
                        dataType: 'json',
                        url: function(params) {
                            return "/get_veredas_and_comunas?type=" + $('#selectTypeZone').val();
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

                $('#zone').on('select2:select', function(e) {
                    var data = e.params.data;
                    $('#zone').val(data.id);
                });
        
        //change label
        $('#selectTypeZone').change(function(){
            if ($(this).val() == 'Corregimiento') {
                $("#label_zone").html('Vereda');
            } else {
                $("#label_zone").html('Barrio');
            }
        });
    });
</script>
@endsection