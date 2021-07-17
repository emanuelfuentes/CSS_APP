<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style="color:black">
        <p> Estimado/a {{ $user->nombres }} {{ $user->apellidos }}.</p>
        <p>
            Se le notifica que usted ha sido agregado/a satisfactoriamente al siguiente proceso de aceptación del proyecto de horas sociales {{$user->nombre}}. 
            Se le solicita estar pendiente de su correo institucional para futuras actualizaciones.<br>

            Si usted no solicitó este proceso o si tiene dudas al respecto, por favor ponerse en contacto con nosotros.
        </p><br>
        <p>
            Atentamente, Centro de Servicio Social.
        </p><br><br>
    </div>
    
    <p style="color:gray">
        Este es un correo autogenerado por el sistema. <br>
        Centro de servicio social, UCA | css@uca.edu.sv <br>
        Tel. 2210-6600 ext.427 | 2210-6680
    </p>
</body>
</html>