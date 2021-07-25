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
        <p> Estimado/a {{ $user->encargado }}.</p>
        <p>
            Un estudiante ha aplicado al proyecto de horas sociales a su cargo, {{ $user->nombre }}:<br>
                Nombres: {{ $user->nombres }}.<br>
                Apellidos: {{ $user->apellidos }}.<br>
                Correo: {{ $user->correo }}<br>
                Carrera: {{ $user->n_carrera }}.<br><br>

            Se le sugiere revisar el sistema del Centro de Servicio Social UCA en el siguiente link para aceptar o rechazar dicha solicitud.<br>
            <a href="https://uca.edu.sv/css-proyecto/public/">https://uca.edu.sv/css-proyecto/public/</a>
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