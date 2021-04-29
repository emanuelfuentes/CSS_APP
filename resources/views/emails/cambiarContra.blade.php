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
        <p> Estimado/a {{ $user->nombres }},</p>
        <p>
            se solicitó un cambio de contraseña debido a que fue olvidada, por favor haga
            <a href="{{ url('cambiar_contra_olvidada/'.$user->correo) }}"> click aquí</a>
            para crear una nueva.
        </p>
        <p>
            Se le recuerda que este proceso puede realizarse <b style="color:red">una vez por día.</b>
        </p><br>
        <p>
            Atentamente, Centro de Servicio Social.
        </p><br><br>
    </div>
    
    <p style="color:gray">
        Este es un correo autogenerado por el sistema. <br>
        Centro de servicio social, UCA | css@uca.edu.sv <br>
        Tel. 2210-6600 | 2210-6680
    </p>
</body>
</html>