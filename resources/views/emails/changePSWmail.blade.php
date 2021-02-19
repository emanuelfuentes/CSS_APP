<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> Hola {{ $user->nombres }}</h1>
    <p>
        Click para verificar
        <a href="{{ url('cambiar_contra/'.$user->correo) }}"> Cambiar contra</a>
    </p>
</body>
</html>