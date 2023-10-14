@extends('layouts.base')

@section('titulo')
    Formularios
@endsection

@section('css-extra')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <!-- Select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
@endsection

@section('cabecera')
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Puestos de Votacion</h1>
        <p class="fs-5 text-muted">Aqui podras encontrar la gestion de puestos de votacion, solo los administradores pueden crear,
            editar y eliminar puestos de votacion.
        </p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <label for="">Por Nombre</label>
                <input type="text" class="form-control" placeholder="Nombre" aria-label="First name" id="inputNombre">
            </div>
            <div class="col">
                <label for="">Por barrio</label>
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
                <label for="">Por comuna</label>
                <select class="form-select" aria-label="Default select example" id="selectComuna">
                    <option value="" selected>Filtrar por comuna</option>
                    @foreach ($comunas as $comuna)
                    <option value="{{$comuna->id}}">{{$comuna->name}}</option>
                    @endforeach
                </select>
                </select>
            </div>
            <div class="col">
                <label for="">Por corregimiento</label>
                <select class="form-select" aria-label="Default select example" id="selectCorregimiento">
                    <option value="" selected>Filtrar por corregimiento</option>
                    @foreach ($corregimientos as $corregimiento)
                    <option value="{{$corregimiento->id}}">{{$corregimiento->name}}</option>
                    @endforeach
                  </select>
                  </select>
            </div>
          <div class="row">
            <div class="col">
                <label for="">Por vereda</label>
                <select class="form-select" aria-label="Default select example" id="selectVereda">
                    <option value="" selected>Filtrar por vereda</option>
                    @foreach ($veredas as $vereda)
                    <option value="{{$vereda->id}}">{{$vereda->name}}</option>
                    @endforeach
                  </select>
                  </select>
            </div>
            <div class="col text-center">
                <button class="btn btn-success mt-4" id="btnFiltrar">Filtrar</button>
            </div>
          </div>

          <div class="row mt-5">
            <div class="col-10 mb-2 text-center"></div>
            @if (Auth::user()->hasRole(['administrador']))
                <div class="col-2 mb-2 text-center">
                    <a href="{{ route('puestoVotacion.create') }}" class="btn  btn-sm btn-success">Crear Puesto de Votacion</a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('cuerpo')
    <div class="table-responsive">
        <table class="table text-center" id="tabla-puesto-votacion">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Tipo de Zona</th>
                    <th>Barrio/Vereda</th>
                    <th>Accion</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('js-extra')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        //inicializar select 2 (funcion de busqueda en los selects)
        $(document).ready(function() {
           
            $('#selectComuna').select2({
                theme: 'bootstrap-5'
            });
            $('#selectBarrio').select2({
                theme: 'bootstrap-5'
            });
            $('#selectCorregimiento').select2({
                theme: 'bootstrap-5'
            });
            $('#selectVereda').select2({
                theme: 'bootstrap-5'
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var nombre = null;
            var comuna = null;
            var barrio = null;
            var corregimiento = null;
            var vereda = null;

            // muestra todos los elementos
            viewTable(nombre, comuna, corregimiento, barrio, vereda); 

            //filtrar segun los parametos indicados
            $('#btnFiltrar').click(function() {
            nombre = document.getElementById('inputNombre').value;
            comuna = document.getElementById('selectComuna').value;
            barrio = document.getElementById('selectBarrio').value;
            corregimiento = document.getElementById('selectCorregimiento').value;
            vereda = document.getElementById('selectVereda').value;
            $('#tabla-puesto-votacion').DataTable().destroy();
            viewTable(nombre, comuna, corregimiento, barrio, vereda);
        });

            function viewTable(nombre, comuna, corregimiento, barrio, vereda){
            $('#tabla-puesto-votacion').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('puestoVotacion.tabla') }}",
                    type: "GET",
                    data: {
                        // Data to send
                        nombre: nombre,
                        comuna: comuna,
                        barrio: barrio,
                        corregimiento: corregimiento,
                        vereda: vereda
                    
                }
                },
                searching: false,
                columns: [
                    { data: 'identificador', name: 'identificador' },
                    { data: 'nombre', name: 'nombre' },
                    { data: 'descripcion', name: 'descripcion' },
                    { data: 'tipoZona', name: 'tipoZona' },
                    { data: 'zona', name: 'zona' },
                    { data: 'acciones', name: 'acciones'}
                ]
            });
        }

    });
    </script>
@endsection