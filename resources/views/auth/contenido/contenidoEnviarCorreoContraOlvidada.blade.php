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
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/forgottenPassword.css">

</head>

<body>
  <div class="container" id="main-container">
    <div class="form-container card-body">
      <form class="form-horizontal" method="POST" action="{{ route('olvido_contrasenia') }}">
        {{ csrf_field() }}
        <div class="heading">
          <h1>Cambiar contraseña</h1>
          <p>Por favor ingrese su correo y se le enviará un link para poder realizar el cambio de contraseña.</p>
          <p>Se puede realizar el cambio de contraseña una vez por día.</p>
        </div>

        <div class="form-group mb-4 ">
          <input type="text" class="form-control" name="email" value="{{ old('email') }}" style="margin-bottom: 0.5em" placeholder="Correo electrónico">
          @if($errors->first('no_verificado'))
          {!!$errors->first('no_verificado','<span style="color:red">:message</span>')!!}
          @elseif($errors->first('email'))
          {!!$errors->first('email','<span style="color:red">:message</span>')!!}
          @elseif($errors->first('correo_inexistente'))
          {!!$errors->first('correo_inexistente','<span style="color:red">:message</span>')!!}
          @else
          <span class="" style="visibility: hidden; color:red">.</span>
          @endif
        </div>
        <div class="col-md-6 col-md-offset-4">
          <button type="submit" id='btn-submit' class="btn btn-primary">Enviar link</button>
        </div>
      </form>

    </div>
  </div>

  <script src="js/plantilla.js"></script>
</body>

</html>

<!-- 
<body class="c-app flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group">
          <div class="card p-4">
            <form class="form-horizontal" method="POST" action="{{ route('olvido_contrasenia') }}">
              {{ csrf_field() }}
              <div class="card-body">
                <h1>Cambiar contraseña</h1>
                <p>Por favor ingrese su correo y se le enviará un link para poder realizar el cambio de contraseña.
                  Se puede realizar el cambio de contraseña una vez por día.</p>

                <div class="form-group mb-4 ">
                  <input type="text" class="form-control" name="email" value="{{ old('email') }}" style="margin-bottom: 0.5em" placeholder="Correo elelctrónico">
                  @if($errors->first('no_verificado'))
                  {!!$errors->first('no_verificado','<span style="color:red">:message</span>')!!}
                  @elseif($errors->first('email'))
                  {!!$errors->first('email','<span style="color:red">:message</span>')!!}
                  @elseif($errors->first('correo_inexistente'))
                  {!!$errors->first('correo_inexistente','<span style="color:red">:message</span>')!!}
                  @else
                  <span class="" style="visibility: hidden; color:red">.</span>
                  @endif
                </div>
                <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">Enviar link</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


-->