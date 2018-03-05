@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>{{ $user->name }}</h1>

    <div class="mb-3">
      <a href="/{{ $user->username }}/follows">Sigue a <span class="badge badge-dark">{{ $user->follows->count() }}</span></a>
      <a href="/{{ $user->username }}/followers">Seguido por <span class="badge badge-dark">{{ $user->followers->count() }}</span></a>
    </div>

    @if (Auth::check())
      @if (Gate::allows('dms', $user))
        <form class="form-row form-group" action="/{{ $user->username }}/dms" method="post">
          {{ csrf_field() }}
          <div class="col-10">
            <input class="form-control" type="text" name="message">
          </div>
          <div class="col-2">
            <button class="btn btn-success" type="submit">Enviar mensaje privado</button>
          </div>
        </form>
      @endif
      @if (Auth::user()->isFollowing($user))
        <form action="/{{ $user->username }}/unfollow" method="post">
          <div class="form-group">
            @if (session('success'))
              <span class="text-success">{{ session('success') }}</span>
            @endif
            {{ csrf_field() }}
            <button class="btn btn-danger" type="submit" name="button">Dejar de seguir</button>
          </div>
        </form>
      @else
        <form action="/{{ $user->username }}/follow" method="post">
          <div class="form-group">
            @if (session('success'))
              <span class="text-success">{{ session('success') }}</span>
            @endif
            {{ csrf_field() }}
            <button class="btn btn-primary" type="submit" name="button">Seguir</button>
          </div>
        </form>
      @endif
    @endif

    <div class="row">
      @foreach ($user->messages as $message)
        <div class="col-6">
          @include('messages.message')
        </div>
      @endforeach
    </div>
  </div>
@endsection
