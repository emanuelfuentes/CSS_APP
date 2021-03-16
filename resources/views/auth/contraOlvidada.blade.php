
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
            <div class="card">
                <div class="card-body" id="cuerpoc">
                    <h2 id="titulo">Cambiar contraseña</h2>
                    <!--<h2>{{$user->correo}}</h2>-->

                    <form id="form" action="{{ url('/cambiar_contra_olvidada/'.$user->correo) }}" method="post">
                    {{ csrf_field() }}
                        <label for="user" class="label-form">Usuario</label>
                        <input class="mb-2" type="text" name="user" id="user" value="{{$user->correo}}" readonly>

                        <label for="password" class="label-form">Contraseña</label>
                        <input type="password" name="contraseña" id="contraseña">
                        @if($errors->first('contraseña'))
                            {!!$errors->first('contraseña','<span style="color: red;">:message</span>')!!}
                        @else
                            <span style="visibility: hidden;">.</span>
                        @endif

                        <label for="password_confirm" class="label-form">Confirmar contraseña</label>
                        <input type="password" name="confirmar" id="confirmar">
                        @if($errors->first('confirmar'))
                            {!!$errors->first('confirmar','<span style="color: red;margin-bottom:0.5em">:message</span>')!!}
                        @else
                            <span style="visibility: hidden; margin-bottom:0.5em">.</span>
                        @endif
                        <button type="submit" id="submit">Establecer contraseña</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>