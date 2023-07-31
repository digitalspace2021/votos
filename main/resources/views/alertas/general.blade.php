@extends('layouts.base')

@section('titulo')
    Alertas Generales
@endsection

@section('css-extra')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
<style>
    /* Rmplazar la clase table de bootstrap */
    /* Estilos personalizados para la nueva clase "custom-table" */
.custom-table {
  width: 100%;
  margin-bottom: 1rem;
  color: #212529;
  /* Agrega aquí tus estilos personalizados para la nueva clase "custom-table" */
}

.custom-table th,
.custom-table td {
  padding: 0.75rem;
  vertical-align: top;
  border-top: 1px solid #dee2e6;
}

.custom-table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #dee2e6;
}

.custom-table tbody + tbody {
  border-top: 2px solid #dee2e6;
}

.custom-table-sm th,
.custom-table-sm td {
  padding: 0.3rem;
}

/* Estilos para la nueva clase "custom-table" en variantes "striped" y "hover" */
.custom-table-striped tbody tr:nth-of-type(odd) {
  background-color: rgba(0, 0, 0, 0.05);
}

.custom-table-hover tbody tr:hover {
  background-color: rgba(0, 0, 0, 0.075);
}

</style>
@endsection

@section('cabecera')
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">Alertas Generales</h1>
    <p class="fs-5 text-muted">
    </p>
</div>
<div class="container">

      <div class="row">
        <div class="col">
            <label for="">Por cedula</label>
            <input type="text" class="form-control" placeholder="123456789" aria-label="First name" id="cedula">
        </div>
        <div class="col">
            <label for="">Por Nombre</label>
            <input type="text" class="form-control" placeholder="" aria-label="First name" id="inputNombre">
        </div>
      </div>
<br>
      <div class="row">
        <div class="col">
            <label for="">Por Color</label>
            <select class="form-select" aria-label="Default select example" id="selectColor">
                <option value="" selected>Filtrar por Color</option>
                <option value="Rojo" >Rojo</option>
                <option value="Amarillo">Amarillo</option>
                <option value="Verde" >Verde</option>
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
                    <a href="{{ route('alerta.persona') }}" class="btn  btn-sm btn-success">Alertas por persona</a>
                </div>
            @endif
        </div>
        
</div>

@endsection

@section('cuerpo')

<div class="container">
    <table class="custom-table text-center" id="tablas-matriz">
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
                <th>Sabe numero candidato?</th>
                <th>Reuniones familiares, amigos?</th>
                <th>Mensaje de texto?</th>
                <!--<th>Accion</th>-->
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('js-extra')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {

        var cedula = null;
        var nombre = null;
        var color = null;
       

        viewTable(cedula,nombre,color); 

        $('#btnFiltrar').click(function() {
            cedula = document.getElementById('cedula').value;
            nombre = document.getElementById('inputNombre').value;
            color = document.getElementById('selectColor').value;
            $('#tablas-matriz').DataTable().destroy();
            viewTable(cedula,nombre,color); 
        });

        //Generate xls file
        $('#btnExport').click(function() {
            cedula = document.getElementById('cedula').value;
            nombre = document.getElementById('inputNombre').value;
            color = document.getElementById('selectColor').value;
            
            exportAlerta(cedula, nombre, color); 
           
        });
        
    });

    function viewTable(cedula,nombre,color){
        $('#tablas-matriz').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('alerta.tabla') }}",
                type: "GET",
                data: {
                    // Data to send
                    cedula:cedula,
                    nombre:nombre,
                    color:color   
            }
            },
            searching: false,
            columns: [
                { data: 'identificacion', name: 'identificacion'},
                { data: 'nombre', name: 'nombre' },
                { data: 'creador', name: 'creador' },
                { data: 'candidato', name: 'candidato' },
                { data: 'direccion', name: 'direccion' },
                { data: 'telefono', name: 'telefono' },
                { data: 'res_uno', name: 'res_uno', render: function(data) { return '<span >' +((data == 1) ? 'SI' : 'NO')+ '</span>';}},
                { data: 'res_dos', name: 'res_dos', render: function(data) {return '<span >' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                { data: 'res_tres', name: 'res_tres', render: function(data) {return '<span >' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                { data: 'res_cuatro', name: 'res_cuatro', render: function(data) {return '<span >' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                { data: 'res_cinco', name: 'res_cinco', render: function(data) {return '<span >' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                { data: 'res_seis', name: 'res_seis', render: function(data) {return '<span >' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                { data: 'res_siete', name: 'res_siete', render: function(data) { return '<span >' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                { data: 'res_ocho', name: 'res_ocho', render: function(data) {return '<span >' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                { data: 'res_nueve', name: 'res_nueve', render: function(data) {return '<span >' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                { data: 'res_diez', name: 'res_diez', render: function(data) {return '<span >' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                //{ data: 'acciones', name: 'acciones'}
            ],
            rowCallback: function(row, data, dataIndex) {
                const alert = data.alerta;
                if (alert == "Rojo") {
                    $(row).addClass('bg-danger text-light');
                } 
                else if(alert == "Amarillo"){
                    $(row).addClass('bg-warning text-light');
                }
                else {
                    $(row).addClass('bg-success text-light');
                }
            }
        });
    }

    //function generate XLS
    function exportAlerta(cedula, nombre, color){
        $.ajax({
            url: "{{ route('export.alerta') }}", 
            method: 'GET',
            xhrFields: {
                responseType: 'blob' // Indicate that the response is of type Blob
            },
            data: {
                    // Data to send
                    cedula: cedula,
                    nombre: nombre,
                    color: color,
                      
            },
            success: function(response) {
                var downloadLink = document.createElement('a');
                downloadLink.href = URL.createObjectURL(response);
                downloadLink.download = 'Alerta.xlsx'; // File name to download

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