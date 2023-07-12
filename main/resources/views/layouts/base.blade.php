<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo') - IBG TEST</title>

    <!-- imagen de la pestaña-->
    <link rel="icon" href="{{asset('img/politicos.png')}}" type="image/png">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <script src="{{asset('js/highcharts.js')}}"></script>
    <script src="{{asset('js/data.js')}}"></script>
    <script src="{{asset('js/drilldown.js')}}"></script>
    <script src="{{asset('js/exporting.js')}}"></script>
    <script src="{{asset('js/export-data.js')}}"></script>
    <script src="{{asset('js/accessibility.js')}}"></script>

    <style>
        .btn-hover:hover {
            background-color: #f8f8f8;
            color: #333;
        }

        /* view mobiles */
        @media (max-width: 767px) {
            #btn-pVotantes {
                display: none;
            }
        }
    </style>
    @yield('css-extra')
</head>
<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check" viewBox="0 0 16 16">
            <title>Check</title>
            <path
                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
        </symbol>
    </svg>
    <div class="container py-3"">
        <header>
            <div class="{{-- d-flex --}} flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom"
                id="content-nav">

                <nav class="navbar bg-body-tertiary fixed-top">
                    <div class="container-fluid">
                        <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                            <img src="{{asset('img/Politicos.png')}}" alt="" class="me-2" width="60" height="52">
                            <span class="fs-4">Politicos</span>
                        </a>

                      <div>
                        @if (!auth()->check())
                        <a class="me-3 py-2 text-dark text-decoration-none btn-hover" href="{{ route('problems.create') }}" id="btn-pVotantes"><i class="fa fa-users" aria-hidden="true"></i> Posibles Votantes</a>
                        @endif
                          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                      </div>  
                    </div>
                </nav>
                  
                  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                      <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                        <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                            <img src="{{asset('img/Politicos.png')}}" alt="" class="me-2" width="60" height="52">
                            <span class="fs-4">Politicos</span>
                        </a>
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                      <div>
                        <!-- Content navbar-->
                        <nav class="nav flex-column">
                            @auth
                                <a class="me-3 py-2 text-dark text-decoration-none btn-hover" href="{{ route('inicio') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a>
                                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle btn-hover" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-file" aria-hidden="true"></i> Formularios
                                        </a>
                                        <ul class="dropdown-menu">
                                        <li><a class="dropdown-item btn-hover" href="{{ route('formularios') }}">Formularios Oficiales</a></li>
                                        <li><a class="dropdown-item btn-hover" href="{{ route('pre-formularios') }}">Pre-Formularios</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <a class="me-3 py-2 text-dark text-decoration-none btn-hover"
                                    href="{{ auth()->check() ? route('problems.index') : route('problems.create') }}"><i class="fa fa-users" aria-hidden="true"></i> Posibles Votantes</a>
                                @if (Auth::user()->hasRole('administrador'))
                                    <a class="me-3 py-2 text-dark text-decoration-none btn-hover" href="{{ route('usuarios') }}"><i class="fa fa-user" aria-hidden="true"></i> Usuarios</a>
                                @endif
                                <!-- Add by marco Marin 30-06-2023-->
                                @if (Auth::user()->hasRole('administrador'))
                                    <a class="me-3 py-2 text-dark text-decoration-none btn-hover" href="{{ route('matriz') }}"><i class="fa fa-table" aria-hidden="true"></i> Matriz de seguimiento</a>
                                @endif
                                <!---->
                                @if (Auth::user()->hasRole('administrador'))
                                    <a class="me-3 py-2 text-dark text-decoration-none btn-hover"
                                        href="{{ route('candidatos') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Candidatos</a>
                                @endif
                                @if (Auth::user()->hasRole('administrador'))
                                    <a class="me-3 py-2 text-dark text-decoration-none btn-hover" href="{{ route('cargos') }}"><i class="fa fa-list-ol" aria-hidden="true"></i> Cargos</a>
                                @endif

                                @if (Auth::user()->hasRole('administrador'))
                                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle btn-hover" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-signal" aria-hidden="true"></i> Estadisticas
                                        </a>
                                        <ul class="dropdown-menu">
                                        <li><a class="dropdown-item btn-hover" href="{{ url('statitics') }}">Estadisticas Generales</a></li>
                                        <li><a class="dropdown-item btn-hover" href="{{ route('statistics') }}">Estadisticas Seguimiento</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                @endif
                                
                                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle btn-hover" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-universal-access" aria-hidden="true"></i> Cuenta
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="py-2 text-dark text-decoration-none" href="#"> <b> {{ Auth::user()->name }} </b></a></li>
                                            <li>
                                                <a class="py-2 mx-2 text-dark text-decoration-none btn-hover" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                @else
                                <a class="me-3 py-2 text-dark text-decoration-none"
                                    href="{{ route('problems.create') }}"><i class="fa fa-users" aria-hidden="true"></i> Posibles Votantes</a>
                                <a class="me-3 py-2 text-dark text-decoration-none" href="{{ route('login') }}"><i class="fa fa-key" aria-hidden="true"></i> Login</a>
                            @endauth
                        </nav>
                        <!-- end content navbar-->
                      </div>
                    </div>
                  </div>
            </div>
              @yield('cabecera')
        </header>
        <!-- end nav-->
        <main> 
            @yield('cuerpo')
        </main>

        @include('sweetalert::alert')

        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md">
                    <small class="d-block mb-3 text-muted">Desarrollado por {{ env('DEV') }} &copy;
                        {{ date('Y') }}</small>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('js-extra')

</body>
</html>