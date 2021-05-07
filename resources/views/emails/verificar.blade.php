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
        <p> Estimado/a {{ $user->nombres }} {{ $user->apellidos }}</p>
        <p>
            Usted ha creado una cuenta nueva en el sistema de horas sociales CSS, por favor haga 
            <b style="color:red"><a href="{{ url('verificar_usuario/'.$user->correo) }}"> click aquí</a></b>
            para verificar su cuenta y cambiar su contraseña.
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
