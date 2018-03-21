@extends('layouts.app')

@section('content')
  <div class="mt-3">
    <h2>{{ $user->name }}</h2>
  </div>

  <div class="mb-3 follow-link">
    <a href="/{{ $user->username }}/follows">Sigue a <span class="badge badge-laratter">{{ $user->follows->count() }}</span></a>
    <a class="ml-3" href="/{{ $user->username }}/followers">Seguido por <span class="badge badge-laratter">{{ $user->followers->count() }}</span></a>
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
@endsection
