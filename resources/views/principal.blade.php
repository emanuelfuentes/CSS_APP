<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Centro de Servicio Social | UCA">
    <meta name="author" content="">
    <meta name="keyword" content="Sistema de inscripción de proyectos CSS UCA">
    <link rel="shortcut icon" href="img/favicon.ico">
    <title>Centro de Servicio Social | UCA</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    <link href="css/plantilla.css" rel="stylesheet">

</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
<div id="app">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="img/UCA.6b065e25.png" class="img-avatar" alt="admin@bootstrapmaster.com">
                    <span class="d-md-down-none"> 000000 </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Cuenta</strong>
                    </div>
                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Perfil</a>
                    <a class="dropdown-item" href="{{route('logout')}}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i> Cerrar sesión</a>

                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display:none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        </ul>
    </header>

    <div class="app-body">

    @if(Auth::check())
        @if(Auth::user()->idRol == 1)
            @include('plantilla.adminSidebar')
        @else
            @include('plantilla.sidebar')
        @endif
    @else
        @include('plantilla.sidebar')

    @endif
        <!-- Contenido Principal -->
        @yield('dashboard')
        <!-- /Fin del contenido principal -->
    </div>

</div> <!--CLOSING VUE -->

    <footer class="app-footer">
        <span><a href="http://www.uca.edu.sv/servicio-social/">Centro de Servicio Social | UCA</a> &copy; 2017</span>
        <span class="ml-auto">Desarrollado por <a href="#"></a></span>
    </footer>

    
    <script src="js/app.js"></script>
    <script src="js/plantilla.js"></script>
</body>

</html>