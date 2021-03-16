
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet'>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/olvidec.css') }}">
    <link href="{{ asset('js/plantilla.css') }}" >
    <link href="{{ asset('js/jquery.min.css') }}" >
    <link href="{{ asset('js/bootstrap.min.css') }}" >
    <!--<script src="js/plantilla.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>-->
    
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
                @if($errors->first('Contraseña'))
                    {!!$errors->first('Contraseña','<span style="color: red">:message</span>')!!}
                @else
                    <span style="visibility: hidden;">.</span>
                @endif

                <br><br>
                Confirmar contraseña: <br>
                <input type="password" name="confirm_psw" id="confirm_psw">
                @if($errors->first('confirmar contraseña'))
                    {!!$errors->first('confirmar contraseña','<span style="color: red">:message</span>')!!}
                @else
                    <span style="visibility: hidden;">.</span>
                @endif
                <button type="submit">Establecer contraseña</button>

            </form>
        </div>
    </div>
</body>
</html>