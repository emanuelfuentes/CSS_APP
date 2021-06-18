<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v3.4.0
* @link https://coreui.io
* Copyright (c) 2020 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="es">
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
    <link href="css/login.css" rel="stylesheet">
    <script src="js/plantilla.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body class="cuerpo">
    <div class="container">
    <img class="logo" src="img/UCA.6b065e25.png" width="125" height="150">
    <h1 id="inicios">Inicio de sesión</h1>
      <div class="card-group">
        <div class="card p-4">
          <form class="form-horizontal was-validated" style="height: 100%" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="card-body" id="cardb">
              <div class="form-group">
                <label for="carnet" class="label-form">Carnet</label>
                <input class="form-control hijos" value="{{old('carnet')}}" id="carnet" name="carnet"  type="text">
                @if($errors->first('carnet'))
                  {!!$errors->first('carnet','<span style="color: red">:message</span>')!!}
                @else
                  <span style="visibility: hidden;">.</span>
                @endif
              </div>
              <div class="form-group mb-2">
                <label for="con" class="label-form">Contraseña</label>
                <input class="form-control hijos" id="contraseña" name="contraseña" type="password">
                @if($errors->first('contraseña'))
                  {!!$errors->first('contraseña','<span style="color: red">:message</span>')!!}
                @elseif($errors->first('email_inexistente'))
                  {!!$errors->first('email_inexistente','<span style="color: red">:message</span>')!!}
                @else
                  <span style="visibility: hidden;">.</span>
                @endif
              </div>
              <div class="form-group mb-2{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                <div class="col-md-12">
                  {!! app('captcha')->display() !!}
                  @if ($errors->has('g-recaptcha-response'))
                      <span style="color: red">
                          {{ $errors->first('g-recaptcha-response') }}
                      </span>
                  @else
                      <span style="visibility: hidden;">.</span>
                  @endif
                </div>
              </div>
              
              <div>
                <button class="btn btn-primary px-4 hijos" id="btni" style="background-color: #003C71" type="submit">Iniciar sesion</button>
              </div>
            </div>
          </form>
        </div>      
      </div>
      <div id="espacio">
        <a class="btn btn-link px-0" id="olvido" type="button" href="{{ url('/contra_olvidada_form') }} ">¿Olvidó la contraseña?</a>
        <a class="btn btn-link px-0" id="registrar" type="button" href="{{ url('/register_form') }}">Registrese ahora!</a>
      </div>
    </div>
  </body>
</html>
