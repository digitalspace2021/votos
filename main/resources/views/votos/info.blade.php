@extends('layouts.base')

@section('titulo')
Informacion votaciones
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
    <h1 class="display-4 fw-normal">Informacion de votaciones</h1>
    {{-- <p class="fs-5 text-muted">Aqui se tendra registro de las votaciones hechas en base a los formularios
        registrados,
        diciendo si voto o no.</p> --}}
</div>

@if (session('success') || session('error'))
<div class="alert alert-{{session('success') ? 'success' : 'danger'}} mx-2">
    {{session('success') ?? session('error')}}
</div>
@endif
@endsection

@section('cuerpo')
<div class="container">
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card d-flex">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <h5>Total votantes</h5>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center gap-5">
                    <div class="content-1">
                        {{-- icon people lg --}}
                        <i class="fas fa-users fa-5x"></i>
                    </div>
                    <div class="content-2">
                        <h3>
                            {{$all_votantes}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card d-flex">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <h5>Total votaron</h5>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center gap-5">
                    <div class="content-1">
                        {{-- icon people color green lg --}}
                        <i class="fas fa-users fa-5x text-success"></i>
                    </div>
                    <div class="content-2">
                        <h3>
                            {{$votantes_yes}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card d-flex">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <h5>Total no votaron</h5>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center gap-5">
                    <div class="content-1">
                        {{-- icon people color green lg --}}
                        <i class="fas fa-users fa-5x text-danger"></i>
                    </div>
                    <div class="content-2">
                        <h3>
                            {{$votantes_no}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="my-3">
    <div class="row mt-3">
        <div class="col-md-4 mb-3">
            <div class="card d-flex">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <h5>Votos Gobernacion</h5>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center gap-5">
                    <div class="content-1">
                        {{-- icon people lg --}}
                        <i class="fas fa-user fa-5x"></i>
                    </div>
                    <div class="content-2">
                        <h3>
                            {{$votos_to_gobernacion}} de {{$votantes_yes}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card d-flex">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <h5>Votos Alcaldia</h5>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center gap-5">
                    <div class="content-1">
                        {{-- icon people color green lg --}}
                        <i class="fas fa-user fa-5x text-success"></i>
                    </div>
                    <div class="content-2">
                        <h3>
                            {{$votos_to_alcaldia}} de {{$votantes_yes}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card d-flex">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <h5>Votos Concejo</h5>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center gap-5">
                    <div class="content-1">
                        {{-- icon people color green lg --}}
                        <i class="fas fa-user fa-5x text-danger"></i>
                    </div>
                    <div class="content-2">
                        <h3>
                            {{$votos_to_concejo}} de {{$votantes_yes}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('components.loading')
@endsection

@push('custom-js')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script></script>
@endpush