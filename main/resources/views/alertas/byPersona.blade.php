@extends('layouts.base')

@section('titulo')
    Personas
@endsection

@section('css-extra')
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
    <h5 class="display-6 fw-normal">Seguimiento por Persona</h5>
        
            <div class="container">
                <form class="row g-3 mt-5" id="form-alert" method="POST">
                    <div class="alert alert-danger" role="alert" id="alert"></div>
                    <div class="col-auto">
                        <input type="text" readonly class="form-control-plaintext"  value="Cedula">
                      </div>
                    <div class="col-auto">
                      <label for="inputCedula" class="visually-hidden">Identificacion</label>
                      <input type="number" class="form-control" id="inputCedula" name="inputCedula">
                    </div>
                    <div class="col-auto">
                      <button type="submit" class="btn btn-primary mb-3">Consultar</button>
                    </div>
                </form>
    
                <div class="container mt-3 mb-2 justify-content-center align-items-center" id="info-user" style="display:none">
                    
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-auto">
                                <label for="">Nombre</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" id="inputNombre" readonly>
                                
                            </div>
                        </div>
                        
                        <div class="row mt-1">
                            <div class="col-auto">
                                <label for="">Direccion</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" id="inputDireccion" readonly>
                            </div>
                        </div>
        
                        <div class="row mt-1">
                            <div class="col-auto">
                                <label for="">Telefono</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" id="inputTelefono" readonly>
                            </div>
                        </div>
        
                        <div class="row mt-1">
                            <div class="col-auto">
                                <label for="">Referido</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" id="inputReferido" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
         
</div>
@endsection

@section('cuerpo')
<div class="container" style="display: none" id="table-alert">
    <h3>Estado general de la Persona <span id="status"></span></h3>
    <br><hr><br>
    <table class="custom-table text-center" id="tablas-matriz">
        <thead>
            <tr>
                <th>Sabe votar?</th>
                <th>Tiene publicidad?</th>
                <th>Tiene transporte?</th>
                <th>Se le ha echo seguimiento?</th>
                <th>Se le ha visitado?</th>
                <th>Lugar votacion cerca?</th>
                <th>Participacion en actividades?</th>
                <!--<th>Accion</th>-->
            </tr>
        </thead>
    </table>
    <br><hr><br>

    <h3>Cuantas veces se ha llamado? <span id="calls"></span> </h3>
    <br>
    <form action="{{route('matriz.editPregunta')}}" method="get">
        <input type="hidden" class="form-control" name="id_matriz" id="id_matriz_cuatro" readonly>
        <input type="hidden" class="form-control" name="pregunta" id="pregunta" value="4" readonly>
        <button class="btn btn-primary" type="submit" >Editar</button>
    </form>
    
    <br><hr><br>
    <div  id="containerCalls">
        <p class="text-light h5 p-3">Se ha llamado <span id="numCalls"></span> veces.</p>
        <p class="text-light h5 p-3">Durante las siguientes fechas: <span id="dateCalls"></span></p>
    </div>
    <br><hr><br>

    <h3>Cuantas veces se ha visitado? <span id="visits"></span></h3>
    <br>
    <form action="{{route('matriz.editPregunta')}}" method="get">
        <input type="hidden" class="form-control" name="id_matriz" id="id_matriz_cinco" readonly>
        <input type="hidden" class="form-control" name="pregunta" id="pregunta" value="5" readonly>
        <button class="btn btn-primary" type="submit" >Editar</button>
    </form>

    <br><hr><br>
    {{-- <div id="containerVisits">
        <p class="text-light h5 p-3">Se ha visitado <span id="numVisits"></span> veces.</p>
        <p class="text-light h5 p-3">Durante las siguientes fechas: <span id="dateVisits"></span></p>
    </div>
    <br><hr><br> --}}
</div>

<div class="text-center">
    <a  href="{{ route('alerta.index') }}" class="btn btn-danger">Cancelar</a>
</div>

@endsection

@section('js-extra')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        //Request, obtain user data from the form according to CC
        $(document).ready(function() {
            $('#alert').hide();
            $("#form-alert").submit(function(event) {
                // Prevenir que el formulario se envíe automáticamente (comportamiento por defecto)
                event.preventDefault();
                
                $.ajax({
                    url: "{{ route('alerta.form') }}", 
                    type: 'GET', 
                    dataType: 'json', 
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status == 0) {
                            $('#info-user').hide();
                            $('#table-alert').hide();
                            $('#alert').text(response.msg);
                            $('#alert').show();
                        } else {
                            $('#alert').hide();
                            $('#info-user').show();
                            const status = document.getElementById('status');
                            document.getElementById('id_matriz_cuatro').value = response[0].id_matriz;
                            document.getElementById('id_matriz_cinco').value = response[0].id_matriz;
                            document.getElementById('inputNombre').value = response[0].nombre;
                            document.getElementById('inputDireccion').value = response[0].direccion;
                            document.getElementById('inputTelefono').value = response[0].telefono;
                            document.getElementById('inputReferido').value = response[0].referido;
                            if(response[0].alerta =='Rojo'){
                                status.textContent = "!Alerta" ;
                                status.classList.remove("text-warning");
                                status.classList.remove("text-success");
                                status.classList.add("text-danger");
                            }
                            else if(response[0].alerta =='Amarillo'){
                                status.textContent = "!Advertencia" ;
                                status.classList.remove("text-danger");
                                status.classList.remove("text-success");
                                status.classList.add("text-warning");
                            }
                            else{
                                status.textContent = "Excelente!!" ;
                                status.classList.remove("text-warning");
                                status.classList.remove("text-danger");
                                status.classList.add("text-success");
                            }
                            $('#tablas-matriz').DataTable().destroy();
                            viewTable(response[0].identificacion,null,null); 
                            $('#table-alert').show();

                            //llamadas
                            const llamadas = response[0].llamadas ?? '';
                            var numLlamadas = 0;
                            if(llamadas){
                                const arrayllamadas = llamadas.split(", ");
                                numLlamadas = arrayllamadas.length;
                            }
                            
                            const statusCall = document.getElementById('calls');
                            const containerCall = document.getElementById('containerCalls');
                            const numCall = document.getElementById('numCalls');
                            const dateCall = document.getElementById('dateCalls');

                            if(numLlamadas <= 3 && numLlamadas > 0){
                                statusCall.textContent = "!Alerta" ;
                                statusCall.classList.remove("text-warning");
                                statusCall.classList.remove("text-success");
                                statusCall.classList.add("text-danger");

                                containerCall.classList.remove("bg-success");
                                containerCall.classList.remove("bg-warning");
                                containerCall.classList.add("bg-danger");

                                numCall.textContent = numLlamadas ;
                                dateCall.textContent = llamadas ;
                            }
                            else if(numLlamadas >= 4 && numLlamadas <= 8){
                                statusCall.textContent = "!Advertencia" ;
                                statusCall.classList.remove("text-success");
                                statusCall.classList.remove("text-danger");
                                statusCall.classList.add("text-warning");

                                containerCall.classList.remove("bg-success");
                                containerCall.classList.remove("bg-danger");
                                containerCall.classList.add("bg-warning");

                                numCall.textContent = numLlamadas ;
                                dateCall.textContent = llamadas ;
                            }
                            else if(numLlamadas > 8){
                                statusCall.textContent = "!Excelente" ;
                                statusCall.classList.remove("text-danger");
                                statusCall.classList.remove("text-warning");
                                statusCall.classList.add("text-success");

                                containerCall.classList.remove("bg-warning");
                                containerCall.classList.remove("bg-danger");
                                containerCall.classList.add("bg-success");

                                numCall.textContent = numLlamadas ;
                                dateCall.textContent = llamadas ;
                            }
                            else {
                                statusCall.textContent = "!Alerta" ;
                                statusCall.classList.remove("text-warning");
                                statusCall.classList.remove("text-success");
                                statusCall.classList.add("text-danger");

                                containerCall.classList.remove("bg-success");
                                containerCall.classList.remove("bg-warning");
                                containerCall.classList.add("bg-danger");

                                numCall.textContent = 0;
                                dateCall.textContent = "No se ha llamado" ;
                            }

                            //Visitas
                            const visitas = response[0].visitas ?? '';
                            var numVisitas = 0;

                           if(visitas){
                                const arrayVisitas = visitas.split(", ");
                                 numVisitas = arrayVisitas.length;
                           }
                        
                            const statusVisit = document.getElementById('visits');
                            const containerVisit = document.getElementById('containerVisits');
                            const numVisit = document.getElementById('numVisits');
                            const dateVisit = document.getElementById('dateVisits');

                            if(numVisitas <= 3 && numVisitas > 0){
                                statusVisit.textContent = "!Alerta" ;
                                statusVisit.classList.remove("text-warning");
                                statusVisit.classList.remove("text-success");
                                statusVisit.classList.add("text-danger");

                                containerVisit.classList.remove("bg-warning");
                                containerVisit.classList.remove("bg-success");
                                containerVisit.classList.add("bg-danger");

                                numVisit.textContent = numVisitas ;
                                dateVisit.textContent = visitas ;
                            }
                            else if(numVisitas >= 4 && numVisitas <= 8){
                                statusVisit.textContent = "!Advertencia" ;
                                statusVisit.classList.remove("text-success");
                                statusVisit.classList.remove("text-danger");
                                statusVisit.classList.add("text-warning");

                                containerVisit.classList.remove("bg-success");
                                containerVisit.classList.remove("bg-danger");
                                containerVisit.classList.add("bg-warning");

                                numVisit.textContent = numVisitas ;
                                dateVisit.textContent = visitas ;
                            }
                            else if(numVisitas > 8){
                                statusVisit.textContent = "!Excelente" ;
                                statusVisit.classList.remove("text-danger");
                                statusVisit.classList.remove("text-warning");
                                statusVisit.classList.add("text-success");

                                containerVisit.classList.remove("bg-warning");
                                containerVisit.classList.remove("bg-danger");
                                containerVisit.classList.add("bg-success");

                                numVisit.textContent = numVisitas ;
                                dateVisit.textContent = visitas ;
                            }
                            else  {
                                statusVisit.textContent = "!Alerta" ;
                                statusVisit.classList.remove("text-warning");
                                statusVisit.classList.remove("text-success");
                                statusVisit.classList.add("text-danger");

                                containerVisit.classList.remove("bg-success");
                                containerVisit.classList.remove("bbg-warning");
                                containerVisit.classList.add("bg-danger");

                                numVisit.textContent = numVisitas ;
                                dateVisit.textContent = "No se ha visitado" ;
                            }
                        }
                        
                    },
                    error: function(xhr, status, error) {
                        console.error('Error en la petición:', error);
                    }
                });
    
            });
        });
    </script>
    <script>
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
                    { data: 'res_uno', name: 'res_uno', render: function(data) { return '<span >' +((data == 1) ? 'SI' : 'NO')+ '</span>';}},
                    { data: 'res_dos', name: 'res_dos', render: function(data) {return '<span >' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                    { data: 'res_tres', name: 'res_tres', render: function(data) {return '<span >' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                    { data: 'res_cuatro', name: 'res_cuatro', render: function(data) {return '<span >' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                    { data: 'res_cinco', name: 'res_cinco', render: function(data) {return '<span >' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                    { data: 'res_seis', name: 'res_seis', render: function(data) {return '<span >' +((data == 1) ? 'SI' : 'NO')+ '</span>';} },
                    { data: 'res_siete', name: 'res_siete', render: function(data) { return '<span >' +((data == 1) ? 'SI' : 'NO')+ '</span>';} }
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
    
    </script>
    
@endsection