<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo') - IBG TEST</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    {{--
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    --}}

    <script src="{{asset('js/highcharts.js')}}"></script>
    <script src="{{asset('js/data.js')}}"></script>
    <script src="{{asset('js/drilldown.js')}}"></script>
    <script src="{{asset('js/exporting.js')}}"></script>
    <script src="{{asset('js/export-data.js')}}"></script>
    <script src="{{asset('js/accessibility.js')}}"></script>


    @yield('css-extra')


    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

        .navbar-toggle {
            display: none;
            cursor: pointer;
        }

        .bar {
            width: 25px;
            height: 3px;
            background-color: #333;
            margin: 5px 0;
            transition: background-color 0.3s ease;
        }

        #navbar{
            display: block;
        }

        @media (max-width: 768px) {

            .navbar-toggle {
                display: block;
            }

            #navbar {
                display: none;
                flex-direction: column;
                align-items: flex-start;
                padding: 10px;
            }

            #navbar a {
                display: block;
                margin-bottom: 10px;
            }

            #navbar a:last-child {
                margin-bottom: 0;
            }
        }

        #content-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>

<body>

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check" viewBox="0 0 16 16">
            <title>Check</title>
            <path
                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
        </symbol>
    </svg>

    <div class="container py-3">
        <header>
            <div class="{{-- d-flex --}} flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom" id="content-nav">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2" viewBox="0 0 118 94"
                        role="img">
                        <title>IBG TEST</title>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"
                            fill="currentColor"></path>
                    </svg>
                    <span class="fs-4">IBG TEST</span>
                </a>
                <div class="navbar-toggle" id="navbarToggle">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
                <nav class="{{-- d-inline-flex --}} mt-2 mt-md-0 ms-md-auto" id="navbar">
                    @auth
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{ route('inicio') }}">Inicio</a>
                    <a class="me-3 py-2 text-dark text-decoration-none"
                        href="{{ route('formularios') }}">Formularios</a>
                    <a class="me-3 py-2 text-dark text-decoration-none"
                        href="{{ route('problems.index') }}">Problematicas</a>
                    @if (Auth::user()->hasRole('administrador'))
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{ route('usuarios') }}">Usuarios</a>
                    @endif
                    @if (Auth::user()->hasRole('administrador'))
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{ route('candidatos') }}">Candidatos</a>
                    @endif
                    @if (Auth::user()->hasRole('administrador'))
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{ route('cargos') }}">Cargos</a>
                    @endif
                    @if (Auth::user()->hasRole('administrador'))
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{ url('statitics') }}">Estadisticas</a>
                    @endif
                    <a class="py-2 text-dark text-decoration-none" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <a class="py-2 text-dark text-decoration-none" href="#"> | {{ Auth::user()->name }}</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @else
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{ route('login') }}">Login</a>
                    @endauth
                </nav>

            </div>

            @yield('cabecera')
        </header>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    @yield('js-extra')

    <script>
        $(document).ready(function() {
            $('#navbarToggle').click(function() {
                /* display block or display none */
                $('#navbar').toggle();
            });
        });

        /* if not mobile view nabvar how display block */
        $(window).resize(function() {
            if ($(window).width() > 768) {
                $('#navbar').css('display', 'block');
            } else {
                $('#navbar').css('display', 'none');
            }
        });
    </script>
</body>

</html>