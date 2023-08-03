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
    <div id="containerVisits">
        <p class="text-light h5 p-3">Se ha visitado <span id="numVisits"></span> veces.</p>
        <p class="text-light h5 p-3">Durante las siguientes fechas: <span id="dateVisits"></span></p>
    </div>
    <br><hr><br>

    <h3>Ha participado en actividades de forma frecuente? <span id="activities"></span></h3>
    <br>
    <form action="{{route('matriz.editPregunta')}}" method="get">
        <input type="hidden" class="form-control" name="id_matriz" id="id_matriz_siete" readonly>
        <input type="hidden" class="form-control" name="pregunta" id="pregunta" value="7" readonly>
        <!--<button class="btn btn-primary" type="submit" >Editar</button>-->
    </form>

    <br><hr><br>
    <div id="containerActivities">
        <p class="text-light h5 p-3">Ha participado <span id="numActivities"></span> veces.</p>
        <p class="text-light h5 p-3">Durante las siguientes fechas: <span id="dateActivities"></span></p>
    </div>
    <br><hr><br>

    <h3>Realizo reuniones con familiares y amigos? <span id="meeting"></span></h3>
    <br>
    <form action="{{route('matriz.editPregunta')}}" method="get">
        <input type="hidden" class="form-control" name="id_matriz" id="id_matriz_nueve" readonly>
        <input type="hidden" class="form-control" name="pregunta" id="pregunta" value="9" readonly>
        <!--<button class="btn btn-primary" type="submit" >Editar</button>-->
    </form>

    <br><hr><br>
    <div id="containerMeeting">
        <p class="text-light h5 p-3">Se han reunido <span id="numMeeting"></span> veces.</p>
        <p class="text-light h5 p-3">Durante las siguientes fechas: <span id="dateMeeting"></span></p>
    </div>
    <br><hr><br>
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
                            document.getElementById('id_matriz_siete').value = response[0].id_matriz;
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
                            getAlert(numLlamadas, 'calls', 'containerCalls', 'dateCalls','numCalls', llamadas);

                            

                            //Visitas
                            const visitas = response[0].visitas ?? '';
                            var numVisitas = 0;

                           if(visitas){
                                const arrayVisitas = visitas.split(", ");
                                 numVisitas = arrayVisitas.length;
                           }
                           getAlert(numVisitas, 'visits', 'containerVisits', 'dateVisits','numVisits', visitas);
                        
                            

                            //Actividades
                            const actividades = response[0].actividades ?? '';
                            var numActividades = 0;

                           if(actividades){
                                const arrayActividades = actividades.split(", ");
                                 numActividades = arrayActividades.length;
                           }
                           getAlert(numActividades, 'activities', 'containerActivities', 'dateActivities','numActivities', actividades);
                        
                           //Reuniones
                           const reuniones = response[0].reuniones ?? '';
                            var numReuniones = 0;

                           if(reuniones){
                                const arrayReuniones = reuniones.split(", ");
                                 numReuniones = arrayReuniones.length;
                           }
                           getAlert(numReuniones, 'meeting', 'containerMeeting', 'dateMeeting','numMeeting', reuniones);
                        }
                        
                    },
                    error: function(xhr, status, error) {
                        console.error('Error en la petición:', error);
                    }
                });
    
            });
        });
        function getAlert(cant, status_e, container_e,pDate_e, pCant_e, data){
            const status = document.getElementById(status_e);
            const container = document.getElementById(container_e);
            const numCall = document.getElementById(pCant_e);
            const dateCall = document.getElementById(pDate_e);
            if(cant <= 3 && cant > 0){
                                status.textContent = "!Alerta" ;
                                status.classList.remove("text-warning");
                                status.classList.remove("text-success");
                                status.classList.add("text-danger");

                                container.classList.remove("bg-success");
                                container.classList.remove("bg-warning");
                                container.classList.add("bg-danger");

                                numCall.textContent = cant ;
                                dateCall.textContent = data ;
                            }
                            else if(cant >= 4 && cant <= 8){
                                status.textContent = "!Advertencia" ;
                                status.classList.remove("text-success");
                                status.classList.remove("text-danger");
                                status.classList.add("text-warning");

                                container.classList.remove("bg-success");
                                container.classList.remove("bg-danger");
                                container.classList.add("bg-warning");

                                numCall.textContent = cant ;
                                dateCall.textContent = data ;
                            }
                            else if(cant > 8){
                                status.textContent = "!Excelente" ;
                                status.classList.remove("text-danger");
                                status.classList.remove("text-warning");
                                status.classList.add("text-success");

                                container.classList.remove("bg-warning");
                                container.classList.remove("bg-danger");
                                container.classList.add("bg-success");

                                numCall.textContent = cant ;
                                dateCall.textContent = data ;
                            }
                            else {
                                status.textContent = "!Alerta" ;
                                status.classList.remove("text-warning");
                                status.classList.remove("text-success");
                                status.classList.add("text-danger");

                                container.classList.remove("bg-success");
                                container.classList.remove("bg-warning");
                                container.classList.add("bg-danger");

                                numCall.textContent = 0;
                                dateCall.textContent = "No hay registros" ;
                            }
        }
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