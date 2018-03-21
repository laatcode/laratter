@extends('layouts.app')

@section('content')
  <form action="/auth/facebook/register" method="post">
    {{ csrf_field() }}
    <div class="card">
      <div class="card-body">
        <img class="img-thumbnail" src="{{ $user->avatar }}">
        <div class="form-group">
          <label for="name">Nombre</label>
          <input class="form-control" type="text" name="name" value="{{ $user->name }}" @if ($user->name) readonly @endif>
          </div>
          <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input class="form-control" type="text" name="email" value="{{ $user->email }}" @if ($user->email) readonly @endif>
            </div>
            <div class="form-group">
              <label for="username">Nombre de usuario</label>
              <input class="form-control" type="text" name="username" value="{{ old('username') }}">
            </div>
          </div>
          <div class="card-footer">
            <button class="btn btn-primary" type="submit">Registrarse</button>
          </div>
        </div>
      </form>
@endsection
