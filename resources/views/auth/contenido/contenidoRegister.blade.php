<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v3.4.0
* @link https://coreui.io
* Copyright (c) 2020 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet'>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/register.css" rel="stylesheet">
    <script src="js/plantilla.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- <link href="css/plantilla.css" rel="stylesheet"> -->

  </head>
  <body class="cuerpo">
    <div class="container">
      <h1 id="titulo">Register</h1>
        <div class="card-group">
            <div class="card p-4">
                <form class="form-horizontal" method="POST" action="{{ route('registrar') }}">
                    {{ csrf_field() }}
                    <div class="card-body">
                        

                        <div class="form-group mb-3">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo electrónico">
                        </div>

                        <div class="form-group mb-3">
                            <input id="nombres" type="text" class="form-control" name="nombres" value="{{ old('nombres') }}" placeholder="Nombres">
                        </div>

                        <div class="form-group mb-3">
                            <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{ old('apellidos') }}" placeholder="Apellidos">
                        </div>

                        <div class="form-group mb-3">
                            <select class="form-control" id="genero" name="genero">
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" style="background-color: #003C71" id="registrarbtn">Register</button>
                    </div>
                </form>
            </div>
        </div>
      <!-- @yield('register') -->
    </div>
    <script src="js/plantilla.js"></script>
  </body>
</html>