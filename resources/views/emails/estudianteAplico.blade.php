<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3> Estimado {{ $user->encargado }}.</h1>
    <p>
        Un estudiante ha aplicado al proyecto de horas sociales a su cargo, {{ $user->nombre }}:<br>
            Nombres: {{ $user->nombres }}.<br>
            Apellidos: {{ $user->apellidos }}.<br>
            Correo: {{ $user->correo }}.<br><br>

        Se le sugiere revisar el sistema del Centro de Servicio Social UCA para aceptar o rechazar dicha solicitud.
    </p><br>
    <p>
        Este es un correo autogenerado por el sistema, porfavor no responder. <br>
        <i>Centro de Servicio Social, UCA.</i>
    </p>
</body>
</html>