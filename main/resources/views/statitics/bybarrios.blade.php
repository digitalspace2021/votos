@extends('layouts.base')

@section('titulo')
    Actualizar usuario
@endsection

@section('css-extra')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
        rel="stylesheet" />
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h5 class="display-6 fw-normal">Estadisticas</h5>

        <div class="col-12">
            <label for="candidato_id" class="form-label">Candidato :

                @foreach ($candidatos as $item)
                    @if ($item->id == $candidato)
                        <label>
                            {{ $item->name }}
                    @endif

            </label>
            @endforeach

            </label>
            <select class="form-control" name="candidato_id" id="candidato_id" onchange="getStatitics()" required></select>
            <div class="invalid-feedback">
                Este campo es requerido.
            </div>
        </div>

        <div class="w3-bar w3-black">
            <button class="btn btn-white btn-sm" onclick="openCity('container1')">Por Registrador</button>
            <button class="btn btn-white btn-sm" onclick="openCity('container2')">Por Corregimientos</button>
            <button class="btn btn-white btn-sm" onclick="openCity('container3')">Por Comunas</button>
        </div>
    </div>
@endsection

@section('cuerpo')
    <!--<figure class="highcharts-figure">-->

    <div id="container1" class="city"></div>

    <div id="container2" class="city" style="display:none">

    </div>

    <div id="container3" class="city" style="display:none"></div>

    <!--</figure>-->
@endsection

@section('js-extra')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script defer>
        window.onload = async function() {

            let data1 = <?= $DataUsers ?>;
            let data2 = <?= $DataCorregimientos ?>;
            let data3 = <?= $DataComunas ?>;

            let result1 = [];
            let result2 = [];
            let result3 = [];

            await data1.forEach(element => {
                result1.push(element)
            });

            result1 = result1.map(obj => ({
                ...obj,
                y: parseInt(obj.y)
            }));

            await data2.forEach(element => {
                result2.push(element)
            });

            result2 = result2.map(obj => ({
                ...obj,
                y: parseInt(obj.y)
            }));

            await data3.forEach(element => {
                result3.push(element)
            });

            result3 = result3.map(obj => ({
                ...obj,
                y: parseInt(obj.y)
            }));

            const chart1 = await Highcharts.chart('container1', {
                chart: {
                    type: 'column'
                },
                title: {
                    align: 'left',
                    text: 'Votos por registrador'
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
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Total votos'
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
                            // format: '{point.y:.1f}%'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                },

                series: [{
                    name: 'Formularios',
                    colorByPoint: true,
                    data: result1
                }],
                drilldown: {
                    breadcrumbs: {
                        position: {
                            align: 'right'
                        }
                    },
                }
            });
            const chart2 = await Highcharts.chart('container2', {
                chart: {
                    type: 'column'
                },
                title: {
                    align: 'left',
                    text: 'Votos por Corregimientos'
                },
                subtitle: {
                    align: 'left',
                    text: 'Discrimiado por Corregimientos.'
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Total votos'
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
                            // format: '{point.y:.1f}%'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                },

                series: [{
                    name: 'Formularios',
                    colorByPoint: true,
                    data: result2
                }],
                drilldown: {
                    breadcrumbs: {
                        position: {
                            align: 'right'
                        }
                    },
                }
            });
            const chart3 = await Highcharts.chart('container3', {
                chart: {
                    type: 'column'
                },
                title: {
                    align: 'left',
                    text: 'Votos por Comunas'
                },
                subtitle: {
                    align: 'left',
                    text: 'Discrimiado por Comunas.'
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Total votos'
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
                            // format: '{point.y:.1f}%'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                },

                series: [{
                    name: 'Formularios',
                    colorByPoint: true,
                    data: result3
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

        $('#candidato_id').select2({
            theme: "bootstrap",
            ajax: {
                dataType: 'json',
                url: "{!! route('util.lista_candidatos') !!}",
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

        async function getStatitics() {
            if ($('#candidato_id').val()) {
                window.location.href = '/statitics/' + $('#candidato_id').val()
            }
        }

        async function openCity(cityName) {
            var i;
            var x = document.getElementsByClassName("city");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            document.getElementById(cityName).style.display = "block";
        }
    </script>
@endsection
