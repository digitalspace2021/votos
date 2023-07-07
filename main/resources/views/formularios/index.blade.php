@extends('layouts.base')

@section('titulo')
    Formularios
@endsection

@section('css-extra')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Formularios</h1>
        <p class="fs-5 text-muted">Aqui podras encontrar la gestion de formularios, solo los administradores pueden crear,
            editar y eliminar formularios.

        

        <!-- import -->
        <div class="actions mt-5">
            <a href="{{ route('import.view') }}" class="btn btn-sm btn-success">
                <i class="fa fa-upload"></i>
                Importar </a>
        </div>
        <!-- end import -->
        </p>

        <div class="container">
            <!-- filtros -->
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
                    <label for="">Por creador</label>
                    <select class="form-select" aria-label="Default select example" id="selectCreador">
                        <option value="" selected>Filtrar por creador</option>
                        @foreach ($creadores as $creador)
                        <option value="{{$creador->id}}">{{$creador->name}}</option>
                        @endforeach
                      </select>
                </div>
              </div>
        
              <div class="row">
                <div class="col">
                    <label for="">Por cedula</label>
                    <input type="text" class="form-control" placeholder="123456789" aria-label="First name" id="InputCedula">
                </div>
                <div class="col">
                    <label for="">Por nombre</label>
                    <input type="text" class="form-control" placeholder="Nombre" aria-label="First name" id="InputNombre">
                </div>
              </div>

              <div class="row">
                <div class="col">
                    <label for="">Por Comuna</label>
                    <select class="form-select" aria-label="Default select example" id="selectComuna">
                        <option value="" selected>Filtrar por comuna</option>
                        @foreach ($comunas as $comuna)
                        <option value="{{$comuna->id}}">{{$comuna->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="">Por Barrio</label>
                    <select class="form-select" aria-label="Default select example" id="selectBarrio">
                        <option value="" selected>Filtrar por barrio</option>
                        @foreach ($barrios as $barrio)
                        <option value="{{$barrio->id}}">{{$barrio->name}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
        
              <div class="row">
                <div class="col">
                    <label for="">Por corregimiento</label>
                    <select class="form-select" aria-label="Default select example" id="selectCorregimiento">
                        <option value="" selected>Filtrar por corregimiento</option>
                        @foreach ($corregimientos as $corregimiento)
                        <option value="{{$corregimiento->id}}">{{$corregimiento->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="">Por Vereda</label>
                    <select class="form-select" aria-label="Default select example" id="selectVereda">
                        <option value="" selected>Filtrar por vereda</option>
                        @foreach ($veredas as $vereda)
                        <option value="{{$vereda->id}}">{{$vereda->name}}</option>
                        @endforeach
                    </select>
                </div>
              </div>

              <div class="row">
                <div class="col">
                    <label for="">Por fecha</label>
                    <input class="form-control" type="date" id="inputDate">
                </div>
                <div class="col">
                    <button class="btn btn-success mt-4" id="btnFiltrar">Filtrar</button>
                </div>
                
              </div>
                

            <!-- End filtros -->
        </div>
    </div>

    <div class="row mt-5">
        @if (Auth::user()->hasRole(['administrador']))
            <div class="col-10">
                <a href="{{ route('export.forms') }}" class="btn  btn-sm btn-success">Exportar</a>
            </div>
        @endif
        @if (Auth::user()->hasRole(['administrador', 'simple']))
            <div class="col-2 mb-2 text-center">
                <a href="{{ route('formularios.crear') }}" class="btn  btn-sm btn-success">Crear formulario</a>
            </div>
        @endif
    </div>
        
        
@endsection

@section('cuerpo')
    <div class="table-responsive">
        <table class="table text-center" id="tablas-formularios">
            <thead>
                <tr>
                    <th>Creador</th>
                    <th>Identificación</th>
                    <th>Nombre completo</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Dirección</th>
                    <th>Puesto de votacion</th>
                    <th>Fecha actualizacion</th>
                    <th>Accion</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('js-extra')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var candidato = null;
            var creador = null;
            var cedula = null;
            var nombre = null;
            var comuna = null;
            var barrio = null;
            var corregimiento = null;
            var vereda = null;
            var fecha = null;
            viewTable(candidato,creador,cedula,nombre,comuna,barrio,corregimiento,vereda,fecha);

            $('#btnFiltrar').click(function() {
            candidato = document.getElementById('selectCandidato').value;
            creador = document.getElementById('selectCreador').value;
            cedula = document.getElementById('InputCedula').value;
            nombre = document.getElementById('InputNombre').value;
            comuna = document.getElementById('selectComuna').value;
            barrio = document.getElementById('selectBarrio').value;
            corregimiento = document.getElementById('selectCorregimiento').value;
            vereda = document.getElementById('selectVereda').value;
            fecha = document.getElementById('inputDate').value;
            $('#tablas-formularios').DataTable().destroy();
            viewTable(candidato,creador,cedula,nombre,comuna,barrio,corregimiento,vereda,fecha);
        });
        });

        function viewTable(candidato,creador,cedula,nombre,comuna,barrio,corregimiento,vereda,fecha){
            $('#tablas-formularios').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json',
                },
                ajax: {
                url: "{!! route('formularios.tabla') !!}",
                type: "GET",
                data: {
                    // Datos a enviar
                    candidato: candidato,
                    creador: creador,
                    cedula: cedula,
                    nombre: nombre,
                    comuna: comuna,
                    barrio: barrio,
                    corregimiento: corregimiento,
                    vereda: vereda,
                    fecha: fecha   
                }
            },
                columns: [{
                        data: 'creador',
                        name: 'creador'
                    },
                    {
                        data: 'identificacion',
                        name: 'identificacion'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'telefono',
                        name: 'telefono'
                    },
                    {
                        data: 'direccion',
                        name: 'direccion'
                    },
                    {
                        data: 'puesto_votacion',
                        name: 'puesto_votacion'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'acciones',
                        name: 'acciones'
                    }
                ]
            });
        }
    </script>
@endsection
