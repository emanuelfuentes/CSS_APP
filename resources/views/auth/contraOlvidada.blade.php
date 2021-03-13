<!DOCTYPE html>
<html lang="en">
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
            <h2>Cambiar contra</h2>
            <h2>{{$user->correo}}</h2>

            <form action="{{ url('/cambiar_contra_olvidada/'.$user->correo) }}" method="post">
            {{ csrf_field() }}
                Contraseña: <br>
                <input type="password" name="password" id="password">

                <br><br>
                Confirmar contraseña: <br>
                <input type="password" name="password_confirm" id="password_confirm">

                <button type="submit">Establecer contraseña</button>

            </form>
        </div>
    </div>
</body>
</html>