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
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
  <div class="container-fluid">
    <div class="row no-gutter">
      <div class="col-md-8 col-lg-8">
        <div class="login d-flex align-items-center py-4">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col-lg-8 mx-auto">
                <img class="mx-auto d-block" src="img/UCA.6b065e25.png">
                <h3 class="login-heading mb-5 text-center font-weight-bold">Centro de Servicio Social</h3>
                <form class="was-validated" method="POST" action="{{ route('login') }}">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="carnet" class="label-form">Carnet</label>
                    <input class="form-control hijos" value="{{old('carnet')}}" id="carnet" name="carnet" type="text">
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

                  <div class="d-flex justify-content-center form-group mb-2{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                    <div class="col-md-12 text-center">
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

                  <div class="d-flex justify-content-center">
                    <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2 mx-auto" style="background-image: linear-gradient( 109.6deg,  rgba(39,142,255,1) 11.2%, rgba(98,113,255,0.78) 100.2% );" type="submit">Iniciar sesion</button>
                  </div>

                  <div class="d-flex justify-content-center mt-4" style="gap: 24px;">
                    <a class="small" href="{{ url('/register_form') }}">Registra tu cuenta!</a>
                    <a class="small" href="{{ url('/contra_olvidada_form') }}">Olvidaste tu contraseña?</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="d-none d-md-flex col-md-4 col-lg-4 bg-image image"></div>
    </div>
  </div>
</body>

</html>