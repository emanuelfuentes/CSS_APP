<?php
    $ruta = App\Http\Controllers\UserController::ruta();
?>
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
  <script src="js/jquery.min.js"></script>

</head>
<script>
  $(document).ready(function() {
    $('#gform').submit(function() {
      $('#loading').show();
      $('#btn-submit').prop('disabled', true);
    });
  });
  
</script>

<body>
  <div class="container" id="main-container">
    <div class="form-container card-body">
      <form id="gform" class="form-horizontal" method="POST" action="{{ route('olvido_contrasenia') }}">
        {{ csrf_field() }}
        <div class="heading">
          <h1>Cambiar contraseña</h1>
        </div>
        <div style="padding: 0 16px;">
          <p>Por favor ingrese su carnet y se le enviará un link al correo asociado para poder realizar el cambio de contraseña. 
          <b> <a style="color:red">Se puede realizar el cambio de contraseña una vez por día.</a> </b></p>
        </div>

        <div class="form-group mb-2" style="padding: 0 16px;">
          <input type="text" class="form-control" name="carnet" value="{{ old('carnet') }}">
          @if($errors->first('no_verificado'))
            {!!$errors->first('no_verificado','<span style="color:red">:message</span>')!!}
          @elseif($errors->first('carnet'))
            {!!$errors->first('carnet','<span style="color:red">:message</span>')!!}
          @elseif($errors->first('correo_inexistente'))
            {!!$errors->first('correo_inexistente','<span style="color:red">:message</span>')!!}
          @elseif($errors->first('cambio_fecha'))
            {!!$errors->first('cambio_fecha','<span style="color:red">:message</span>')!!}
          @else
          <span class="" style="visibility: hidden; color:red">.</span>
          @endif
        </div>
        <div style="display:none;" id="loading">
          <div style=" display: flex;  flex-direction:column; justify-content: center; align-items: center;">
            <img src="<?php echo $ruta; ?>/img/snake.gif" alt="Loading" /><span  > Cargando....</span>
          </div>
        </div>
        
        <div class="col-md-6 col-md-offset-4">
          <button type="submit" id='btn-submit' style="margin-left: 16px; margin-bottom: 16px; background-image: linear-gradient( 109.6deg,  rgba(39,142,255,1) 11.2%, rgba(98,113,255,0.78) 100.2% );" class="btn btn-primary">Enviar link</button>
        </div>
      </form>

    </div>
  </div>

  <script src="js/plantilla.js"></script>
</body>

</html>