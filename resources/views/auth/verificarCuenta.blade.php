<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet'>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="./olvidec.css" rel="stylesheet">
    <script src="js/plantilla.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body class="cuerpo">
    <div class="container">
        <div class="card-group">
            <div class="card">
                <div class="card-body" id="cuerpoc">
                    <!--<img class="icon" src="img/lock.png" width="125" height="150">-->
                    <h2 id="titulo">Actualice su contraseña</h2>
                    <!--<h2 id="usuario">{{$user->correo}}</h2>-->

                    <form id="form" action="{{ url('/cambiar_contra/'.$user->correo) }}" method="post">
                    {{ csrf_field() }}
                        Usuario: <br>
                        <input type="text" name="password" id="password" value="{{$user->correo}}" readonly>
                        <br>
                        Contraseña: <br>
                        <input type="password" name="password" id="password">

                        <br>
                        Confirmar contraseña: <br>
                        <input type="password" name="password_confirm" id="password_confirm">
                        <br>
                        <button type="submit" id="submit">Establecer contraseña</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
    <style>
    <?php include "css/olvidec.css" ?>
    </style>
    <style>
    <?php include "css/bootstrap.min.css" ?>
    </style>
</html>