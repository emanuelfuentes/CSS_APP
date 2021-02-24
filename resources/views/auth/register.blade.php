@extends('auth.contenido.contenidoRegister')

@section('register')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-group">
            <div class="card p-4">
                <form class="form-horizontal" method="POST" action="{{ route('registrar') }}">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <h1>Register</h1>

                        <div class="form-group mb-3">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo electrónico">
                        </div>

                        <div class="form-group mb-3">
                            <input id="nombres" type="text" class="form-control" name="nombres" value="{{ old('nombres') }}" placeholder="Nombres">
                        </div>

                        <div class="form-group mb-3">
                            <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{ old('apellidos') }}" placeholder="Apellidos">
                        </div>

                        <div class="form-group mb-3">
                            <select class="form-control" id="genero" name="genero">
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
