@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Inicio de sesión</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">Correo electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Iniciar sesión
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    ¿Olvidó su contraseña?
                                </a>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                      <div class="col-md-8 offset-md-4 mt-2">
                        <div class="btn btn-facebook">
                          <span class="fab fa-facebook-square fa-lg"></span>
                          <a class="ml-1" href="/auth/facebook">Ingresar con Facebook</a>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-8 offset-md-4 mt-2">
                        <div class="btn btn-github">
                          <i class="fab fa-github fa-lg"></i>
                          <a class="ml-1" href="/auth/github">Ingresar con Github</a>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-8 offset-md-4 mt-2">
                        <div class="btn btn-twitter">
                          <i class="fab fa-github fa-lg"></i>
                          <a class="ml-1" href="/auth/twitter">Ingresar con Twitter</a>
                        </div>
                      </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
