@extends('layouts.base')

@section('titulo')
    actividades
@endsection

@section('css-extra')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <!-- Select 2 -->
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
        <h1 class="display-4 fw-normal">Participaci&oacute;n de Actividades</h1>
        <p class="fs-5 text-muted">Aqui podras encontrar la gestion de actividades, solo los administradores pueden eliminar actividades.
        </p>
    </div>

    <div class="container">
        <div class="row">
            @if (Auth::user()->hasRole(['administrador']) || Auth::user()->hasRole(['callcenter']))
            <div class="col">
                <label for="">Por Cedula</label>
                <input class="form-control" type="number" name="inputCedula" id="inputCedula">
            </div>
            @endif
            <div class="col">
                <label for="">Por Fecha</label>
                <input class="form-control" type="date" name="inputFecha" id="inputFecha">
            </div>
        </div>
        <div class="row">
            @if (Auth::user()->hasRole(['administrador']) || Auth::user()->hasRole(['callcenter']))
            <div class="col">
                <label for="">Por Nombre / Apellido</label>
                <input class="form-control" type="text" name="inputNombre" id="inputNombre">   
            </div>
            @endif
            <div class="col text-center">
                <button class="btn btn-success mt-4" id="btnFiltrar">Filtrar</button>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-10 mb-2 text-center"></div>
                @if (Auth::user()->hasRole(['administrador']) || Auth::user()->hasRole(['simple']) || Auth::user()->hasRole(['callcenter']))
                    <div class="col-2 mb-2 text-center">
                        <a href="{{ route('actividad.create') }}" class="btn  btn-sm btn-success">Crear Actividad</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('cuerpo')
    <div class="container">
        <div class="table-responsive">
            <table class="custom-table text-center" id="tabla-actividades">
                <thead>
                    <tr>
                        <th>Fecha Actividad</th>
                        <th>Descripcion</th>
                        <th>Evidencia</th>
                        <th>Nombre Completo</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Accion</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('js-extra')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            var dominio = '{{asset("storage/")}}';
            var cedula = null;
            var fecha = null;
            var nombre = null;
            
            // muestra todos los elementos
            viewTable(cedula, fecha, nombre); 

            //filtrar segun los parametos indicados
            $('#btnFiltrar').click(function() {
            cedula = document.getElementById('inputCedula').value;
            fecha = document.getElementById('inputFecha').value;
            nombre = document.getElementById('inputNombre').value;
            $('#tabla-actividades').DataTable().destroy();
            viewTable(cedula, fecha, nombre); 
        });

            function viewTable(cedula, fecha, nombre){
            $('#tabla-actividades').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('actividad.tabla') }}",
                    type: "GET",
                    data: {
                        // Data to send
                        cedula: cedula,
                        fecha: fecha,
                        nombre: nombre
                    
                }
                },
                searching: false,
                columns: [
                    { data: 'fecha', name: 'fecha' },
                    { data: 'descripcion', name: 'descripcion' },

                    { data: 'evidencia', name: 'evidencia',  render: function(data) {if (image(data)) {
                    return '<img src="' + dominio + '/' + data + '" alt="Foto" class="img-fluid" style="max-width: 80px; max-height: 80px;" />';
                    } else {return '<i class="fa fa-file"></i>';}
                    }},

                    { data: 'nombre', name: 'nombre' },
                    { data: 'direccion', name: 'direccion' },
                    { data: 'telefono', name: 'telefono' },
                    { data: 'acciones', name: 'acciones'}
                ],
                rowCallback: function(row, data, dataIndex) {
                    const alert = data.cantidad;
                    if (alert <= 3 && alert !=0) {
                        $(row).addClass('bg-danger text-light');
                    } 
                    else if(alert >=4 && alert <=8){
                        $(row).addClass('bg-warning text-light');
                    }
                    else {
                        $(row).addClass('bg-success text-light');
                    }
                }
            });
        }

    });

    //verificar si es una imagen 
    function image(url) {
        return /\.(jpg|jpeg|png|gif)$/i.test(url);  
    }
    </script>
    
@endsection