@extends('auth.contenido2')

@section('register')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-group">
            <div class="card p-4">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <h1>Register</h1>
                        <div class="form-group">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="form-group mb-3">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}"  > 
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="form-group mb-3">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="form-group mb-3">
                                <input id="password" type="password" class="form-control" name="password" >
                                {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
                            </div>
                        </div>
<!--
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
