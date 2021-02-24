<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Cambiar contra</h2>
    <h2>{{$user->correo}}</h2>

    <form action="{{ url('/cambiar_contra/'.$user->correo) }}" method="post">
    {{ csrf_field() }}
        Contraseña: <br>
        <input type="password" name="password" id="password">

        <br><br>
        Confirmar contraseña: <br>
        <input type="password" name="password_confirm" id="password_confirm">

        <button type="submit">Establecer contraseña</button>

    </form>
</body>
</html>