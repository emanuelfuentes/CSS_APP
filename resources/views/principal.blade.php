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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <!-- Icons -->
    <link href="css/plantilla.css" rel="stylesheet">

</head>

<body class="app sidebar-fixed aside-menu-fixed aside-menu-hidden">
<div id="app">
    

    <div class="app-body" style="margin-top: 0;">

    @if(Auth::check())
        @if(Auth::user()->idRol == 1)
            @include('plantilla.adminSidebar')
        @else
            @include('plantilla.sidebar')
        @endif
    @else

    @endif
        <!-- Contenido Principal -->
        @yield('dashboard')
        <!-- /Fin del contenido principal -->
    </div>

</div> <!--CLOSING VUE -->

    <footer class="app-footer" style="display: flex; flex-direction: column; justify-content: center; font-size: 12px;">
        <span><a href="http://www.uca.edu.sv/servicio-social/">Centro de Servicio Social | UCA</a> &copy; 2021</span>
        <span>Desarrollado por <a href="#"></a>Grupo de Horas Sociales</span>
    </footer>

    
    <script src="js/app.js"></script>
    <script src="js/plantilla.js"></script>
</body>

</html>