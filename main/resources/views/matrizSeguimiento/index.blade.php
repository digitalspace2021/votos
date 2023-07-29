@php

@endphp
@extends('layouts.base')

@section('titulo')
    Matriz de Seguimiento
@endsection

@section('css-extra')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

@endsection

@section('cabecera')
@include('alertas.modal')
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
              
        </div>
        <div class="col">
            <label for="">Por pregunta</label>
            <select class="form-select" aria-label="Default select example" id="selectPregunta">
                <option value="" selected>Filtrar por pregunta</option>
                <option value="1">Se le enseño a Votar?</option>
                <option value="2">Se le pego Publicidad?</option>
                <option value="3">El dia de las elecciones tiene trasporte?</option>
                <option value="4">Se le ha echo seguimiento constante?</option>
                <option value="5">Se le ha visitado?</option>
                <option value="6">El lugar de votacion es cerca a su casa?</option>
                <option value="7">Ha participado en actividades de forma frecuente?</option>
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
            <label for="">Por comuna</label>
            <select class="form-select" aria-label="Default select example" id="selectComuna">
                <option value="" selected>Filtrar por comuna</option>
                @foreach ($comunas as $comuna)
                <option value="{{$comuna->id}}">{{$comuna->name}}</option>
                @endforeach
            </select>
            </select>
        </div>
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
            @if (Auth::user()->hasRole(['administrador']) || Auth::user()->hasRole(['callcenter']))
                <div class="col-10">
                    <a id="btnExport" class="btn  btn-sm btn-success">Exportar</a>
                </div>
            @endif
            @if (Auth::user()->hasRole(['administrador', 'simple']) || Auth::user()->hasRole(['callcenter']))
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
                <th>Participacion en actividades?</th>
                <th>Accion</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('js-extra')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    //inicializar select 2 (funcion de busqueda en los selects)
    $(document).ready(function() {
    $('#selectCandidato').select2({
            theme: 'bootstrap-5'
    });
    $('#selectPregunta').select2({
        theme: 'bootstrap-5'
    });
    $('#selectPregunta').select2({
        theme: 'bootstrap-5'
    });
    $('#selectComuna').select2({
        theme: 'bootstrap-5'
    });
    $('#selectCorregimiento').select2({
        theme: 'bootstrap-5'
    });
});

</script>
<script>
    $(document).ready(function() {

        var candidato = null;
        var pregunta = null;
        var cedula = null;
        var comuna = null;
        var barrio = null;
        var corregimiento = null;

        viewTable(candidato,pregunta,cedula,comuna,barrio,corregimiento); 

        $('#btnFiltrar').click(function() {
            candidato = document.getElementById('selectCandidato').value;
            pregunta = document.getElementById('selectPregunta').value;
            cedula = document.getElementById('cedula').value;
            comuna = document.getElementById('selectComuna').value;
            barrio = document.getElementById('selectBarrio').value;
            corregimiento = document.getElementById('selectCorregimiento').value;
            $('#tablas-matriz').DataTable().destroy();
            viewTable(candidato,pregunta,cedula,comuna,barrio,corregimiento); 
            console.log('Opción seleccionada: ' + candidato);
        });

        //Generate xls file
        $('#btnExport').click(function() {
            candidato = document.getElementById('selectCandidato').value;
            pregunta = document.getElementById('selectPregunta').value;
            cedula = document.getElementById('cedula').value;
            comuna = document.getElementById('selectComuna').value;
            barrio = document.getElementById('selectBarrio').value;
            corregimiento = document.getElementById('selectCorregimiento').value;
            
            exportMatriz(candidato,pregunta,cedula,comuna,barrio,corregimiento); 
            console.log('Opción seleccionada: ' + candidato);
        });
        
    });

    function viewTable(candidato,pregunta,cedula,comuna,barrio,corregimiento){
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
                    comuna: comuna,
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
                { data: 'res_uno', name: 'res_uno', render: function(data) {const colorClass = (data == 1) ? 'text-success' : 'text-danger'; return '<span class="' + colorClass + '">' +((data == 1) ? 'SI' : 'NO')+ '</span>';}},
                { data: 'res_dos', name: 'res_dos', render: function(data) {const colorClass = (data == 1) ? 'text-success' : 'text-danger'; return '<span class="' + colorClass + '">' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                { data: 'res_tres', name: 'res_tres', render: function(data) {const colorClass = (data == 1) ? 'text-success' : 'text-danger'; return '<span class="' + colorClass + '">' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                { data: 'res_cuatro', name: 'res_cuatro', render: function(data) {const colorClass = (data == 1) ? 'text-success' : 'text-danger'; return '<span class="' + colorClass + '">' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                { data: 'res_cinco', name: 'res_cinco', render: function(data) {const colorClass = (data == 1) ? 'text-success' : 'text-danger'; return '<span class="' + colorClass + '">' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                { data: 'res_seis', name: 'res_seis', render: function(data) {const colorClass = (data == 1) ? 'text-success' : 'text-danger'; return '<span class="' + colorClass + '">' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                { data: 'res_siete', name: 'res_siete', render: function(data) {const colorClass = (data == 1) ? 'text-success' : 'text-danger'; return '<span class="' + colorClass + '">' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                { data: 'acciones', name: 'acciones'}
            ]
        });
    }

    //function generate XLS
    function exportMatriz(candidato,pregunta,cedula,comuna,barrio,corregimiento){
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
                    comuna: comuna,
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

<!-- Alert Modal -->
<script>
    $(document).ready(function() {
        $.ajax({
          url: "{{route('alerta.grave')}}", 
          type: "GET",
          dataType: "json",
          success: function(data) {
            
            for (const user of data) {
                dataTable(user.id_matriz,user.identificacion,user.nombre+' '+user.apellido,user.referido,user.alerta);
            }
            $('#alertModal').modal('show');
          },
          error: function(error) {
            console.log("Error en la petición ", error);
          }
        });
      });
   
      function dataTable(id,cedula,nombre,creador,color) {
        console.log(id);
        const tablaBody = document.getElementById('tableBody');
        const newRow = document.createElement('tr');

        const Cedula = document.createElement('td');
        Cedula.textContent = cedula;

        const Nombre = document.createElement('td');
        Nombre.textContent = nombre;

        const Creador = document.createElement('td');
        Creador.textContent = creador;

        const Acciones = document.createElement('td');
        const btn = document.createElement('a');
        btn.textContent = 'Editar';
        btn.href = '/matrizSeguimiento/edit/'+id;
        btn.classList.add('btn', 'btn-primary');
        Acciones.appendChild(btn);

        newRow.appendChild(Cedula);
        newRow.appendChild(Nombre);
        newRow.appendChild(Creador);
        newRow.appendChild(Acciones);

        if(color == "Rojo"){
            newRow.classList.add('table-danger');
        }
        else{
            newRow.classList.add('table-warning');
        }

        tablaBody.appendChild(newRow);
        }
  </script>
@endsection