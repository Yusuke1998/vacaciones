<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vacaciones</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    {!! Html::style('css/app.css') !!}
    {!! Html::style('DataTables/datatables.min.css') !!}
    @yield('style')
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Vacaciones
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if (!Auth::guest())
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Empleados <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/worker/create') }}">Registrar Empleado</a></li>
                            <li><a href="{{ url('/home') }}">Listar Empleados Activos</a></li>
                            <li><a href="{{ url('/worker/retirados') }}">Listar Empleados Retirados</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Areas <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/area/create') }}">Crear Area</a></li>
                            <li><a href="{{ url('/area') }}">Listar Areas</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Feriados <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/fecha/create') }}">Crear Feriado</a></li>
                            <li><a href="{{ url('/fecha') }}">Listar Feriados</a></li>
                        </ul>
                    </li>
                    @if(Auth::User()->rol === 'administrador')
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/usuario/create') }}">Crear Usuario</a></li>
                            <li><a href="{{ url('/usuario') }}">Listar Usuarios</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
                @endif
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (!Auth::guest())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Salir</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    {!! Html::script('js/jquery.min.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}
    {!! Html::script('DataTables/datatables.min.js') !!}
    @yield('javascript')
</body>
</html>
