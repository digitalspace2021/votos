@php

@endphp
@extends('layouts.base')

@section('titulo')
    Matriz de Seguimiento
@endsection

@section('css-extra')
    
@endsection

@section('cabecera')
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">Matriz de Seguimiento</h1>
    <p class="fs-5 text-muted">Aqui podras encontrar la gestion de seguimientos, solo los administradores pueden crear,
        editar y eliminar seguimientos.
    </p>
</div>
<div class="container">
    <div class="row">
        <div class="col">
            <label for="">Por candidato</label>
            <select class="form-select" aria-label="Default select example" id="selectCandidato">
                <option value="" selected>Filtrar por candidato</option>
                @foreach ($candidatos as $candidato)
                <option value="{{$candidato->id}}">{{$candidato->name}}</option>
                @endforeach
              </select>
              </select>
        </div>
        <div class="col">
            <label for="">Por pregunta</label>
            <select class="form-select" aria-label="Default select example" id="selectPregunta">
                <option value="" selected>Filtrar por pregunta</option>
                <option value="1">Se le enseño a Votar?</option>
                <option value="2">Se le pego Publicidad?</option>
                <option value="3">Tiene carro o moto para ir a Votar?</option>
                <option value="4">Se le ha echo seguimiento constante?</option>
                <option value="5">Se le ha visitado?</option>
                <option value="6">El lugar de votacion es cerca a su casa?</option>
              </select>
        </div>
      </div>

      <div class="row">
        <div class="col">
            <label for="">Por cedula</label>
            <input type="text" class="form-control" placeholder="123456789" aria-label="First name" id="cedula">
        </div>
        <div class="col">
            <label for="">Por barrio</label>
            <select class="form-select" aria-label="Default select example" id="selectBarrio">
                <option value="" selected>Filtrar por barrio</option>
                @foreach ($barrios as $barrio)
                <option value="{{$barrio->id}}">{{$barrio->name}}</option>
                @endforeach
              </select>
        </div>
      </div>
<br>
      <div class="row">
        <div class="col">
            <label for="">Por corregimiento</label>
            <select class="form-select" aria-label="Default select example" id="selectCorregimiento">
                <option value="" selected>Filtrar por corregimiento</option>
                @foreach ($corregimientos as $corregimientos)
                <option value="{{$corregimientos->id}}">{{$corregimientos->name}}</option>
                @endforeach
              </select>
              </select>
        </div>
        <div class="col text-center">
            <button class="btn btn-success mt-4" id="btnFiltrar">Filtrar</button>
        </div>
      </div>

        <div class="row mt-5">
            @if (Auth::user()->hasRole(['administrador']))
                <div class="col-10">
                    <a id="btnExport" class="btn  btn-sm btn-success">Exportar</a>
                </div>
            @endif
            @if (Auth::user()->hasRole(['administrador', 'simple']))
                <div class="col-2 mb-2 text-center">
                    <a href="{{ route('matriz.create') }}" class="btn  btn-sm btn-success">Crear Seguimiento</a>
                </div>
            @endif
        </div>
        
</div>

@endsection

@section('cuerpo')

<div class="container">
    <table class="table text-center" id="tablas-matriz">
        <thead>
            <tr>
                <th>Cedula</th>
                <th>Nombre completo</th>
                <th>Creador</th>
                <th>Candidato</th>
                <th>Dirección</th>
                <th>Telefono</th>
                <th>Sabe votar?</th>
                <th>Tiene publicidad?</th>
                <th>Tiene transporte?</th>
                <th>Se le ha echo seguimiento?</th>
                <th>Se le ha visitado?</th>
                <th>Lugar votacion cerca?</th>
                <th>Accion</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('js-extra')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        var candidato = null;
        var pregunta = null;
        var cedula = null;
        var barrio = null;
        var corregimiento = null;

        viewTable(candidato,pregunta,cedula,barrio,corregimiento); 

        $('#btnFiltrar').click(function() {
            candidato = document.getElementById('selectCandidato').value;
            pregunta = document.getElementById('selectPregunta').value;
            cedula = document.getElementById('cedula').value;
            barrio = document.getElementById('selectBarrio').value;
            corregimiento = document.getElementById('selectCorregimiento').value;
            $('#tablas-matriz').DataTable().destroy();
            viewTable(candidato,pregunta,cedula,barrio,corregimiento); 
            console.log('Opción seleccionada: ' + candidato);
        });

        //Generate xls file
        $('#btnExport').click(function() {
            candidato = document.getElementById('selectCandidato').value;
            pregunta = document.getElementById('selectPregunta').value;
            cedula = document.getElementById('cedula').value;
            barrio = document.getElementById('selectBarrio').value;
            corregimiento = document.getElementById('selectCorregimiento').value;
            
            exportMatriz(candidato,pregunta,cedula,barrio,corregimiento); 
            console.log('Opción seleccionada: ' + candidato);
        });
        
    });

    function viewTable(candidato,pregunta,cedula,barrio,corregimiento){
        $('#tablas-matriz').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('matriz.tabla') }}",
                type: "GET",
                data: {
                    // Data to send
                    candidato: candidato,
                    pregunta: pregunta,
                    cedula: cedula,
                    barrio: barrio,
                    corregimiento: corregimiento
                   
            }
            },
            searching: false,
            columns: [
                { data: 'identificacion', name: 'identificacion' },
                { data: 'nombre', name: 'nombre' },
                { data: 'creador', name: 'creador' },
                { data: 'candidato', name: 'candidato' },
                { data: 'direccion', name: 'direccion' },
                { data: 'telefono', name: 'telefono' },
                { data: 'res_uno', name: 'res_uno', render: function(data) {const colorClass = (data === 1) ? 'text-success' : 'text-danger'; return '<span class="' + colorClass + '">' +((data === 1) ? 'SI' : 'NO')+ '</span>';}},
                { data: 'res_dos', name: 'res_dos', render: function(data) {const colorClass = (data === 1) ? 'text-success' : 'text-danger'; return '<span class="' + colorClass + '">' +((data === 1) ? 'SI' : 'NO')+ '</span>';} },
                { data: 'res_tres', name: 'res_tres', render: function(data) {const colorClass = (data === 1) ? 'text-success' : 'text-danger'; return '<span class="' + colorClass + '">' +((data === 1) ? 'SI' : 'NO')+ '</span>';} },
                { data: 'res_cuatro', name: 'res_cuatro', render: function(data) {const colorClass = (data === 1) ? 'text-success' : 'text-danger'; return '<span class="' + colorClass + '">' +((data === 1) ? 'SI' : 'NO')+ '</span>';} },
                { data: 'res_cinco', name: 'res_cinco', render: function(data) {const colorClass = (data === 1) ? 'text-success' : 'text-danger'; return '<span class="' + colorClass + '">' +((data === 1) ? 'SI' : 'NO')+ '</span>';} },
                { data: 'res_seis', name: 'res_seis', render: function(data) {const colorClass = (data === 1) ? 'text-success' : 'text-danger'; return '<span class="' + colorClass + '">' +((data === 1) ? 'SI' : 'NO')+ '</span>';} },
                { data: 'acciones', name: 'acciones'}
            ]
        });
    }

    //function generate XLS
    function exportMatriz(candidato,pregunta,cedula,barrio,corregimiento){
        $.ajax({
            url: "{{ route('export.matriz') }}", 
            method: 'GET',
            xhrFields: {
                responseType: 'blob' // Indicate that the response is of type Blob
            },
            data: {
                    // Data to send
                    candidato: candidato,
                    pregunta: pregunta,
                    cedula: cedula,
                    barrio: barrio,
                    corregimiento: corregimiento       
            },
            success: function(response) {
                var downloadLink = document.createElement('a');
                downloadLink.href = URL.createObjectURL(response);
                downloadLink.download = 'matrizSeguimiento.xlsx'; // File name to download

                // Add the link to the document and click it to start the download
                document.body.appendChild(downloadLink);
                downloadLink.click();

                // Remove document link
                document.body.removeChild(downloadLink);
            },
            error: function(xhr, status, error) {
                // An error occurred during the request
                console.error(error);
            }
        });

    }
</script>
@endsection