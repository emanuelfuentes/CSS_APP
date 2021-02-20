@extends('auth.contenido')

@section('login')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card-group">
      <div class="card p-4">
        <form class="form-horizontal was-validated" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
          <div class="card-body">
            <h1>Login</h1>
            <p class="text-muted">Sign In to your account</p>

            <div class="form-group mb-3 ">
              <input class="form-control" value="{{old('email')}}" name="email"  type="text" placeholder="e-mail">
              @if($errors->first('email'))
                {!!$errors->first('email','<span class="invalid-feedback">:message</span>')!!}
              @else
                <span class="invalid-feedback" style="visibility: hidden;">.</span>
              @endif
            </div>

            <div class="form-group mb-4 ">
              <input class="form-control" name="password"  type="password" placeholder="Password">
              @if($errors->first('password'))
                {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
              @else
                <span class="invalid-feedback" style="visibility: hidden;">.</span>
              @endif
            </div>
            
            <div class="row">
              <div class="col-6">
                <button class="btn btn-primary px-4" type="submit">Login</button>
              </div>
              <div class="col-6 text-right">
                <button class="btn btn-link px-0" type="button">Forgot password?</button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
        <div class="card-body text-center">
          <div>
            <h2>Sign up</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <a class="btn btn-lg btn-outline-light mt-3" type="button" href="{{ url('/register_form') }}">Register Now!</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
