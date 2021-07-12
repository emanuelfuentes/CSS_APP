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
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <!-- <link href="css/plantilla.css" rel="stylesheet"> -->
</head>
<script>
  $(document).ready(function() {
    function getCarreras() {
      $.ajax({
        type: "GET",
        url: './carreraxfacultad',
        data: {
          idFact: idFact
        },
        success: function(res) {
          $('#carrera').empty();
          $.each(res, function(key) {
            $('#carrera').append($("<option></option>").val(res[key]['idCarrera']).text(res[key]['nombre']));
          })
        },
        error: function() {
          console.log("No se ha seleccionado facultad");
        }
      })
    }

    var idFact = $('#facultad').val()
    getCarreras()

    $('#facultad').change(function() {
      idFact = $('#facultad').val()
      getCarreras()
    })

    $('#gform').submit(function() {
      $('#loading').show();
      $('#registrarbtn').prop('disabled', true);
    });
  });
  
</script>
<body>
  <div class="wrapper">
    <div class="container">
      <div class="card-group">
        <div class="titulo">
          <h1 id="titulo">Registrate</h1>
        </div>
        <div class="card p-4">
          <form id="gform" class="form-horizontal" method="POST" action="{{ route('registrar') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <span> Una vez haya completado este formulario, <b><a style="color:red">por favor revise su correo institucional para completar el registro</a></b> </span>  
            </div>
            <div class="card-body">
              
              <div class="form-group">
                <label for="carnet" class="label-form">Carnet</label>
                <input id="carnet" type="text" class="form-control" name="carnet" value="{{ old('carnet') }}">
                @if($errors->first('carnet'))
                {!!$errors->first('carnet','<span style="color: red">:message</span>')!!}
                @else
                <span style="visibility: hidden;">.</span>
                @endif
              </div>
              <div class="form-group">
                <label for="nombres" class="label-form">Nombres</label>
                <input id="nombres" type="text" class="form-control" name="nombres" value="{{ old('nombres') }}">
                @if($errors->first('nombres'))
                {!!$errors->first('nombres','<span style="color: red">:message</span>')!!}
                @else
                <span style="visibility: hidden;">.</span>
                @endif
              </div>
              <div class="form-group">
                <label for="apellidos" class="label-form">Apellidos</label>
                <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{ old('apellidos') }}">
                @if($errors->first('apellidos'))
                {!!$errors->first('apellidos','<span style="color: red">:message</span>')!!}
                @else
                <span style="visibility: hidden;">.</span>
                @endif
              </div>
              <div class="form-group mb-3">
                <label for="genero" class="label-form">Genero</label>
                <select class="form-control" id="genero" name="genero">
                  <option value="F">Femenino</option>
                  <option value="M">Masculino</option>
                </select>
              </div>
              <label for="facultad" class="label-form">Facultad</label>
              <div class="form-group mb-3">
                <select class="form-control" id="facultad" name="facultad">
                  @foreach($fact as $value)
                  <option value="{{$value['idFacultad']}}">{{$value['nombre']}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group mb-2">
                <label for="carrera" class="label-form">Carrera</label>
                <select class="form-control" id="carrera" name="carrera"></select>
                @if($errors->first('email_existente'))
                {!!$errors->first('email_existente','<span style="color: red">:message</span>')!!}
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
              <div style="display:none;" id="loading">
                <div style=" display: flex;  flex-direction:column; justify-content: center; align-items: center;">
                  <img src="../../../public/img/snake.gif" alt="Loading" /><span  > Cargando....</span>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary" style="background-image: linear-gradient( 109.6deg,  rgba(39,142,255,1) 11.2%, rgba(98,113,255,0.78) 100.2% );" id="registrarbtn">Register</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>