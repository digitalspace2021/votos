@extends('layouts.base')

@section('titulo')
Verificar excel
@endsection

@push('custom-css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
    rel="stylesheet" />

<style>
    .select2-container {
        z-index: 100000;
    }
</style>
@endpush

@section('cabecera')
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h3 class="display-4 fw-normal">Verificar Archivo Excel</h3>
</div>

@if (session('success') || session('error'))
<div class="alert alert-{{session('success') ? 'success' : 'danger'}} mx-2">
    {{session('success') ?? session('error')}}
</div>
@endif
@endsection

@section('cuerpo')
<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-12 mb-3">
            <input type="file" name="" id="file" class="form-control" accept="
            application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,
            application/vnd.ms-excel">
        </div>

        <div class="col-md-6 mb-3 d-flex" style="flex-direction: column;">
            <button class="btn btn-md btn-success col-md-12 mb-2" id="verify">Verificar</button>
            <a href="{{route('import.view')}}" class="btn btn-warning col-md-12 mb-3" id="import" style="display: none">Ir a importar Formularios</a>
        </div>

        <div class="row">
            <div class="col-md-12" id="results">
                <div class="cabeceras" style="display: none;">
                    <h5>
                        Cabeceras
                    </h5>
                    <p>
                        Las siguientes cabezeras no se encuentran en el archivo excel.
                    </p>
                    <ul>
                        <li>
                            <strong>mensaje</strong>
                        </li>
                    </ul>
                </div>

                <div class="identificacion" style="display: none;">
                    <h5>
                        Identificaciones
                    </h5>
                    <p>
                        Las siguientes identificaciones ya se encuentran registradas en la base de datos.
                    </p>

                    <ul>
                        <li>
                            <strong>98498398493</strong> - Oficiales
                        </li>
                        <li>
                            <strong>98498398493</strong> - Posibles votantes
                        </li>
                    </ul>
                </div>

                <div class="alert alert-success message" style="display: none"></div>
            </div>
        </div>
    </div>
</div>
@include('components.loading')
@endsection

@push('custom-js')
<script>
    $(document).ready(function(){

        $("#verify").click(function(){
            let file = $("#file").prop('files')[0];
            let formData = new FormData();
            let token = "{{csrf_token()}}";
            formData.append('file', file);
            formData.append('_token', token);

            let results = $("#results");
            let html = '';

            $.ajax({
                url: "{{route('verify.excel')}}",
                type: "POST",
                data: formData,
                dataType: "JSON",
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $(".loading-overlay").show();
                },
                success: function(response){
                    let messa = $('.message');
                    $('.cabeceras').hide();
                    $('.identificacion').hide();

                    if(response.status == 'success'){
                        messa.html(response.message);
                        messa.show();
                    }

                    $('#import').show();
                },
                statusCode: {
                    400: function(response){
                        $('.message').hide();
                        let cabeceras = $('.cabeceras');
                        let identificacion = $('.identificacion');
                        let resp = JSON.parse(response.responseText);

                        if (resp.headers.length > 0) {
                            cabeceras.show();
                            let html = '<ul>';

                            resp.headers.forEach(element => {
                                html += '<li><strong>' + element + '</strong></li>';
                            });

                            html += '</ul>';

                            cabeceras.find('ul').remove();
                            cabeceras.find('p').after(html);
                        }

                        if (resp.identifications.oficiales.length > 0 || resp.identifications.posibles_votantes.length>0 || resp.identifications.importados.length > 0) {
                            identificacion.show();

                            let html = '<ul>';

                            resp.identifications.oficiales.forEach(element => {
                                html += '<li><strong>' + element + '</strong> - Oficiales</li>';
                            });

                            resp.identifications.posibles_votantes.forEach(element => {
                                html += '<li><strong>' + element + '</strong> - Posibles votantes</li>';
                            });

                            resp.identifications.importados.forEach(element => {
                                html += '<li><strong>' + element + '</strong> - Importados</li>';
                            });

                            html += '</ul>';

                            identificacion.find('ul').remove();
                            identificacion.find('p').after(html);
                        }

                        $('#import').hide();
                    },
                },
                error: function(xhr){
                    $('.message').hide();
                    console.log(xhr);
                },
                complete: function(){
                    $(".loading-overlay").hide();
                }
            })
        })
    });
</script>
@endpush