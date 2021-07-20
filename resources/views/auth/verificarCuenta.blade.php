<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet'>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/verifyAccount.css') }}">
    <link href="{{ asset('js/plantilla.css') }}" >
    <link href="{{ asset('js/jquery.min.css') }}" >
    <link href="{{ asset('js/bootstrap.min.css') }}" >
    <!--<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="./olvidec.css" rel="stylesheet">
    <script src="js/plantilla.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>-->
    <title>Verificar Cuenta</title>
</head>

<body>
    <div class="container" id="main-container">
        <div class="card-body" id="cuerpoc">
            <form id="form-horizontal" action="{{ url('/verificar_usuario/'.$user->correo) }}" method="post">
            {{ csrf_field() }}
                <div class="heading">
                    <h1>Verifique su cuenta</h1>
                </div>
                <div class="form-group row" id="form-group">

                    <label id="luser" for="user" class="label-form">Usuario</label>
                    <input class="form-control" type="text" name="user" id="user" value="{{$user->correo}}" readonly>
                    <span style="margin-top:8px;color:red"> <b>La contraseña debe de cumplir los siguientes requisitos:</b>    <br>
                            -Mínimo 8 caracteres. <br>
                            -Al menos 1 letra mayúscula. <br>
                            -Al menos 1 caracter especial. <br>
                            -Al menos 1 número. <br>
                    </span>
                    <label id="lpassword" for="password" class="label-form">Contraseña</label>
                    <input class="form-control" type="password" name="contraseña" id="contraseña">
                    @if($errors->first('contraseña'))
                        {!!$errors->first('contraseña','<span style="color: red;">:message</span>')!!}
                    @else
                        <span style="visibility: hidden;">.</span>
                    @endif

                    <label for="password_confirm" class="label-form">Confirmar contraseña</label>
                    <input class="form-control" type="password" name="confirmar" id="confirmar">
                    @if($errors->first('confirmar'))
                        {!!$errors->first('confirmar','<span style="color: red;margin-bottom:0.5em">:message</span>')!!}
                    @else
                        <span style="visibility: hidden;">.</span>
                    @endif
                </div>
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" id="submit" class="btn btn-primary">Verificar cuenta</button>
                </div>
            </form>
        </div>
    </div>
</body>

    <style>
    <?php include "css/verifyAccount.css" ?>
    </style>
    <style>
    <?php include "css/bootstrap.min.css" ?>
    </style>
</html>