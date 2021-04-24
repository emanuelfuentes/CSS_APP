<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3> Estimado {{ $user->nombres }} {{ $user->apellidos }},</h1>
    <p>
        se le notifica que <u><b>ha sido aceptado</b></u> para el siguiente proceso de aplicación al proyecto de horas sociales {{ $user->nombre }}. <br>
        Favor estar pendiente de su correo institucional para futuras indicaciones.
    </p><br>
    <p>
        Atentamente, Centro de Servicio Social.</b>
    </p><br><br>
    <p>
        <i>Este es un correo autogenerado por el sistema, por favor no responder. <br>
            Centro de servicio social, UCA.</i>
    </p>
</body>
</html>