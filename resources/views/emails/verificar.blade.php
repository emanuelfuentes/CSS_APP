<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3> Hola {{ $user->nombres }}</h1>
    <p>
        Usted ha creado una cuenta nueva en el sistema de horas sociales CSS, por favor haga 
        <a href="{{ url('verificar_usuario/'.$user->correo) }}"> click aquí</a>
        para verificar su cuenta y cambiar su contraseña.
    </p><br>
    <p>
        Este es un correo autogenerado por el sistema, porfavor no responder. <br>
        <i>Centro de Servicio Social, UCA.</i>
    </p>
</body>
</html>
