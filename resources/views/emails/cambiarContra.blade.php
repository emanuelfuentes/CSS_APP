<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3> Hola {{ $user->nombres }}.</h1>
    <p>
        Se solicitó un cambio de contraseña, por favor haga
        <a href="{{ url('cambiar_contra_olvidada/'.$user->correo) }}"> click aquí</a>
        para cambiarla. Este proceso se puede hacer una vez por día.
    </p>
</body>
</html>