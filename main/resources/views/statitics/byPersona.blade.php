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
            <form class="row g-3" id="userInfo">
                <div class="col-auto">
                    <input type="text" readonly class="form-control-plaintext"  value="Cedula">
                  </div>
                <div class="col-auto">
                  <label for="inputCedula" class="visually-hidden">Identificacion</label>
                  <input type="number" class="form-control" id="inputCedula" name="cedula">
                  <div class="invalid-feedback" id="invalid-feedback-id">
                    Este campo es requerido.
                </div>
                <div class="invalid-feedback" id="invalid-feedback-exist">
                    El usuario consultado no existe.
                </div>
                </div>
                <div class="col-auto">
                  <button type="submit" class="btn btn-primary mb-3">Consultar</button>
                </div>
            </form>

            <div class="container mt-3 mb-2 d-flex justify-content-center align-items-center">
                <div id="img" style="display: none">
                    <img src="{{asset('img/user.png')}}" class="rounded-circle shadow-4 avatar"
                        id="photo" style="width: 150px;" alt="Avatar" />
                </div>
                
                <div class="mt-4" id="user" style="display: none">
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

        <div class="col" id="candidato" style="display: none">
            <div class="container">
                <select class="form-control" name="candidato_id" id="candidato_id"  required>
                    <option value="" selected>Seleccione un candidato</option>
                    @if(!$candidatos->isEmpty())
                        @foreach ($candidatos as $candidato)
                            <option value="{{$candidato->id}}">{{$candidato->name}}</option>
                        @endforeach
                    @endif
                </select>
                <div class="invalid-feedback" id="invalid-feedback">
                    Este campo es requerido.
                </div>
                <br>
                <div class="text-center">
                    <button type="button" class="btn btn-primary mb-3" id="getEstadisticas">Generar Estadisticas</button>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection

@section('cuerpo')
<hr>
<div class="container text-center" style="display: none" id="chart">
    <div class="w3-bar w3-black">
        <button class="btn btn-white btn-sm" onclick="viewChart(1)">Actividades</button>
        <button class="btn btn-white btn-sm" onclick="viewChart(2)">Votos</button>
    </div>
    <div class="contentainer" id="content_actividades">El usuario no tiene actividades disponibles</div>
    <div class="contentainer" id="content_votos" style="display: none;">El Usuario no ha generado votos para el Candidato</div>
</div>

@endsection

@section('js-extra')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
         //Request, obtain user data from the form according to CC
         $(document).ready(function() {
            $("#userInfo").submit(function(event) {
                event.preventDefault();
                const cedula= document.getElementById('inputCedula').value;
                
                if(cedula == ''){
                    $('#invalid-feedback-id').show();
                }
                else{
                    $.ajax({
                    url: "{{ route('actividad.userInfo') }}", 
                    type: 'GET', 
                    dataType: 'json', 
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#invalid-feedback-id').hide();
                        if (response.status == 0) {
                            console.log(response.msg);
                            $('#invalid-feedback-id').hide();
                            $('#invalid-feedback-exist').show();
                        } 
                        else {
                            $('#img').show();
                            $('#user').show();
                            $('#candidato').show();
                            $('#invalid-feedback-exist').hide();
                            const foto= document.getElementById('photo');
                            const ruta = "{{asset('storage/')}}";
                            if(response[0].foto !='' && response[0].foto !=null){
                                foto.src = ruta + "/" + response[0].foto;
                            } 
                            else{
                                foto.src = "{{asset('img/user.png')}}";
                            }

                            document.getElementById('inputNombre').value=response[0].nombre;
                            document.getElementById('inputDireccion').value=response[0].direccion;
                            document.getElementById('inputTelefono').value=response[0].telefono;
                            document.getElementById('inputReferido').value=response[0].referido;

                            //Limpiar campos
                            document.getElementById('candidato_id').value = '';
                            document.getElementById('content_actividades').innerHTML = 'El usuario no tiene actividades disponibles';
                            document.getElementById('content_votos').innerHTML = 'El Usuario no ha generado votos para el Candidato';
                            
                        }
                        
                    },
                    error: function(xhr, status, error) {
                        console.error('Error en la petición:', error);
                    }
                });
                }
                
    
            });

            //btn generar estadisticas
            $("#getEstadisticas").click(function() {
                const candidato = document.getElementById('candidato_id').value;
                const cedula= document.getElementById('inputCedula').value;
                if(candidato == '' ){
                    $('#invalid-feedback').show();
                }
                else if(cedula == ''){
                    $('#invalid-feedback-id').show();
                }
                else{
                    $('#invalid-feedback').hide();
                    $('#invalid-feedback-id').hide();
                    $('#chart').show();
                    actividad(cedula);
                    votos(candidato,cedula);
                }
            });
        });

        //Generar Estadisticas
        function actividad(cedula){
            
            $.ajax({
                    url: "{{ route('statistics.actividad') }}", 
                    type: 'GET', 
                    dataType: 'json', 
                    data: {cedula:cedula},
                    success: function(response) {
                        var cantidad_uno = 0;
                        var cantidad_dos = 0;
                        console.log(response);
                        if (response.status == 0) {
                            console.log(response.msg);
                        } else {
                            if(response.length == 2){
                                cantidad_uno = response[1].cantidad;
                                cantidad_dos = response[0].cantidad;
                            }
                            else{
                                cantidad_uno = response[0].cantidad;
                                cantidad_dos = 0;
                            }
                            generateChart(parseInt(cantidad_uno),parseInt(cantidad_dos),'Actividades','content_actividades',response[0].nombre,response[0].nombre,'Aprobado / Desaprobado','Participaciones');  
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error en la petición:', error);
                    }
                });
        }
        function votos(candidato,cedula){
            
            $.ajax({
                    url: "{{ route('statistics.votos') }}", 
                    type: 'GET', 
                    dataType: 'json', 
                    data: {candidato:candidato,cedula:cedula},
                    success: function(response) {
                        console.log(response);
                        var cantidad = 0;
                            if(response.length > 0){
                                cantidad= response[0].cantidad;
                            }
                           generateChart(parseInt(cantidad),0,'Votos','content_votos',response[0].nombre,response[0].nombre,'Votos','Cantidad');  
                        
                    },
                    error: function(xhr, status, error) {
                        console.error('Error en la petición:', error);
                    }
                });
        }
        

        //visualizar contenedor del grafico
        function viewChart(response){
            const contenedor1 = document.getElementById('content_actividades');
            const contenedor2 = document.getElementById('content_votos');
    
            if(response == 1){
                contenedor1.style.display = 'block';
                contenedor2.style.display = 'none';
            }
            
            if(response == 2){
                contenedor1.style.display = 'none';
                contenedor2.style.display = 'block';
            }
        }

        //genera graficos con la informacion suministrada
        async function generateChart(column1,column2,title,cont,usersSi,usersNo,x,y){
            const chart1 = await Highcharts.chart(cont, {
                chart: {
                    type: 'column'
                },
                title: {
                    align: 'left',
                    text: title
                },
                subtitle: {
                    align: 'left',
                    text: 'Discrimiado por administradores.'
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category',
                    title: {
                        text: x
                    }
                },
                yAxis: {
                    title: {
                        text: y
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                },

                series: [{
                    name: [usersSi],
                    data: [column1],
                    color:'green'
                },
                {
                    name: [usersNo],
                    data: [column2],
                    color:'red'
                }],
                drilldown: {
                    breadcrumbs: {
                        position: {
                            align: 'right'
                        }
                    },
                }
            });
        }
        
    </script>

    
@endsection