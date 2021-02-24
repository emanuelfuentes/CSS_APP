@extends('auth.contenido.contenidoEnviarCorreoContraOlvidada')

@section('contraOlvidada')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-group">
            <div class="card p-4">
                <form class="form-horizontal" method="POST" action="{{ route('olvido_contrasenia') }}">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <h1>Cambiar contraseña</h1>
                        <p>Por favor ingrese su correo y se le enviará un link para poder realizar el cambio de contraseña. 
                        Se puede realizar el cambio de contraseña una vez por día.</p>

                        <div class="form-group mb-4 ">
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}" style="margin-bottom: 0.5em" placeholder="Correo elelctrónico">
                            @if($errors->first('no_verificado'))
                                {!!$errors->first('no_verificado','<span style="color:red">:message</span>')!!}
                            @elseif($errors->first('email'))
                                {!!$errors->first('email','<span style="color:red">:message</span>')!!}
                            @elseif($errors->first('correo_inexistente'))
                                {!!$errors->first('correo_inexistente','<span style="color:red">:message</span>')!!}
                            @else
                                <span class="" style="visibility: hidden; color:red">.</span>
                            @endif
                        </div>
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Enviar link</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection