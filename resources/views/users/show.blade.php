@extends('layouts.app')

@section('content')

  <div class="mt-3 d-flex align-items-center">
    <img class="mr-2 mr-sm-5" src="{{ $user->avatar }}" width="120px" height="120px" style="border-radius:50%;">
    <div class="col">
      <h2>{{ $user->username }}</h2>
      <h5>{{ $user->name }}</h5>

      <div class="mb-2 follow-link">
        <a href="/{{ $user->username }}/follows">Sigue a <span class="badge badge-laratter">{{ $user->follows->count() }}</span></a>
        <a class="ml-2" href="/{{ $user->username }}/followers">Seguido por <span class="badge badge-laratter">{{ $user->followers->count() }}</span></a>
      </div>

      <div class="form-group">
        @if (Auth::check())
          @if (Auth::user()->isFollowing($user))
            <form action="/{{ $user->username }}/unfollow" method="post">
              {{ csrf_field() }}
              <button class="btn btn-danger" type="submit" name="button">Dejar de seguir</button>
            </form>
          @else
            <form action="/{{ $user->username }}/follow" method="post">
              {{ csrf_field() }}
              <button class="btn btn-primary" type="submit" name="button">Seguir</button>
            </form>
          @endif
        @endif
      </div>

    </div>
  </div>

  @if ($user->isPrivate())
    @if (Auth::check() && Gate::allows('bothFollowers', $user))
      @include('users.profile')
    @else
      <div class="col text-center">
        <h3>Esta cuenta es privada</h3>
        <span class="fas fa-lock fa-10x mt-3"></span>
        <p class="mt-3">Sigue esta cuenta para poder ver su contenido</p>
      </div>
    @endif
  @else
    @include('users.profile')
  @endif

@endsection
