@extends('layouts.base')

@section('titulo')
    Matriz de Seguimiento
@endsection

@section('css-extra')
    
@endsection

@section('cabecera')
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h5 class="display-6 fw-normal">Estadisticas de Seguimiento</h5>

    <div class="col-12">
        <label for="candidato_id" class="form-label">Candidato :

             

        </label>
       

        </label>
        <select class="form-control" name="candidato_id" id="candidato_id"  required>
            <option value="" selected></option>
            @forEach($candidatos as $candidato)
            <option value="{{$candidato->id}}">{{$candidato->name}}</option>
            @endForeach
        </select>
        <div class="invalid-feedback">
            Este campo es requerido.
        </div>
    </div>

    <div class="w3-bar w3-black">
        <button class="btn btn-white btn-sm" onclick="viewChart(1)">Votacion</button>
        <button class="btn btn-white btn-sm" onclick="viewChart(2)">Publicidad</button>
        <button class="btn btn-white btn-sm" onclick="viewChart(3)">Transporte</button>
        <button class="btn btn-white btn-sm" onclick="viewChart(4)">Llamadas</button>
        <button class="btn btn-white btn-sm" onclick="viewChart(5)">visitas</button>
        <button class="btn btn-white btn-sm" onclick="viewChart(6)">PuestoDeVotacion</button>
    </div>
</div>
@endsection

@section('cuerpo')
<div id="contenedor1"></div>
<div id="contenedor2" style="display: none;"></div>
<div id="contenedor3" style="display: none;"></div>
<div id="contenedor4" style="display: none;"></div>
<div id="contenedor5" style="display: none;"></div>
<div id="contenedor6" style="display: none;"></div>
{{-- <div style="width: 80%; margin: 0 auto;">
    <canvas id="myChart"></canvas>
  </div> --}}
@endsection

@section('js-extra')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            $('#candidato_id').change(function() {
                const candidato = $(this).val();
                console.log(candidato);
            $.ajax({
                    url: '/politicos-jvn/votos/matrizSeguimiento/statistics', 
                    type: 'GET', 
                    dataType: 'json', 
                    data: {candidato:candidato},
                    success: function(response) {
                        console.log('Respuesta del servidor:', response);

                        //grafico
                        var cont = 1;
                        var sumarSi_uno=0;
                        var sumarNo_uno=0;
                        var sumarSi_dos=0;
                        var sumarNo_dos=0;
                        var sumarSi_tres=0;
                        var sumarNo_tres=0;
                        var sumarSi_cuatro=0;
                        var sumarNo_cuatro=0;
                        var sumarSi_cinco=0;
                        var sumarNo_cinco=0;
                        var sumarSi_seis=0;
                        var sumarNo_seis=0;

                        response.forEach((obj, indice) => {
                            //console.log('pregunta1'+obj['respuesta_uno']);
                            
                            const res = ['respuesta_uno', 'respuesta_dos','respuesta_tres','respuesta_cuatro','respuesta_cinco','respuesta_seis'];

                            for (let [clave, valor] of Object.entries(obj)) {
                            if (res.includes(clave)) {
                                //console.log(clave + ': ' + valor);
                                if(clave=='respuesta_uno'){
                                    if(valor==1){
                                        sumarSi_uno=sumarSi_uno+1;
                                    }
                                    else{
                                        sumarNo_uno=sumarNo_uno+1;
                                    }
                                }
                                if(clave=='respuesta_dos'){
                                    if(valor==1){
                                        sumarSi_dos=sumarSi_dos+1;
                                    }
                                    else{
                                        sumarNo_dos=sumarNo_dos+1;
                                    }
                                }
                                if(clave=='respuesta_tres'){
                                    if(valor==1){
                                        sumarSi_tres=sumarSi_tres+1;
                                    }
                                    else{
                                        sumarNo_tres=sumarNo_tres+1;
                                    }
                                }
                                if(clave=='respuesta_cuatro'){
                                    if(valor==1){
                                        sumarSi_cuatro=sumarSi_cuatro+1;
                                    }
                                    else{
                                        sumarNo_cuatro=sumarNo_cuatro+1;
                                    }
                                }
                                if(clave=='respuesta_cinco'){
                                    if(valor==1){
                                        sumarSi_cinco=sumarSi_cinco+1;
                                    }
                                    else{
                                        sumarNo_cinco=sumarNo_cinco+1;
                                    }
                                }
                                if(clave=='respuesta_seis'){
                                    if(valor==1){
                                        sumarSi_seis=sumarSi_seis+1;
                                    }
                                    else{
                                        sumarNo_seis=sumarNo_seis+1;
                                    }
                                }
                            }
                            }
                            
                            
                        });
                        const responses = {response_uno:[sumarSi_uno,sumarNo_uno,'Se le enseño a votar?'],response_dos:[sumarSi_dos,sumarNo_dos,'Se le pego publicidad?'],
                                            response_tres:[sumarSi_tres,sumarNo_tres,'Tiene carro o moto para ir a votar?'],response_cuatro:[sumarSi_cuatro,sumarNo_cuatro,'Se le ha echo seguimiento constante?'],
                                            response_cinco:[sumarSi_cinco,sumarNo_cinco,'Se le ha visitado?'],response_seis:[sumarSi_seis,sumarNo_seis,'El lugar de votacion es cerca a su casa?']};
                        console.log(responses.response_uno[0]);
                        for (let clave in responses) {
                            generateChart(responses[clave][0],responses[clave][1],responses[clave][2],cont);
                            cont=cont+1;
                        }
                        
                        
                    },
                    error: function(xhr, status, error) {
                        
                        console.error('Error en la petición:', error);
                    }
                });

            });

        });

        async function generateChart(column1,column2,title,cont){
            const chart1 = await Highcharts.chart('contenedor'+cont, {
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
                        text: 'SI / NO'
                    }
                },
                yAxis: {
                    title: {
                        text: 'Cantidad'
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
                    name: ['user1'],
                    data: [column1],
                    color:'green'
                },
                {
                    name: ['user2'],
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

        function viewChart(response){
            const contenedor1 = document.getElementById('contenedor1');
            const contenedor2 = document.getElementById('contenedor2');
            const contenedor3 = document.getElementById('contenedor3');
            const contenedor4 = document.getElementById('contenedor4');
            const contenedor5 = document.getElementById('contenedor5');
            const contenedor6 = document.getElementById('contenedor6');

            if(response == 1){
                contenedor1.style.display = 'block';
                contenedor2.style.display = 'none';
                contenedor3.style.display = 'none';
                contenedor4.style.display = 'none';
                contenedor5.style.display = 'none';
                contenedor6.style.display = 'none';
            }
            if(response == 2){
                contenedor2.style.display = 'block';
                contenedor1.style.display = 'none';
                contenedor3.style.display = 'none';
                contenedor4.style.display = 'none';
                contenedor5.style.display = 'none';
                contenedor6.style.display = 'none';
            }
            if(response == 3){
                contenedor3.style.display = 'block';
                contenedor1.style.display = 'none';
                contenedor2.style.display = 'none';
                contenedor4.style.display = 'none';
                contenedor5.style.display = 'none';
                contenedor6.style.display = 'none';
            }
            if(response == 4){
                contenedor4.style.display = 'block';
                contenedor1.style.display = 'none';
                contenedor3.style.display = 'none';
                contenedor2.style.display = 'none';
                contenedor5.style.display = 'none';
                contenedor6.style.display = 'none';
            }
            if(response == 5){
                contenedor5.style.display = 'block';
                contenedor1.style.display = 'none';
                contenedor3.style.display = 'none';
                contenedor4.style.display = 'none';
                contenedor2.style.display = 'none';
                contenedor6.style.display = 'none';
            }
            if(response == 6){
                contenedor6.style.display = 'block';
                contenedor1.style.display = 'none';
                contenedor3.style.display = 'none';
                contenedor4.style.display = 'none';
                contenedor5.style.display = 'none';
                contenedor2.style.display = 'none';
            }
        }
    </script>
@endsection