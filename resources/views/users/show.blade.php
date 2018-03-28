@extends('layouts.app')

@section('content')

  <div class="mt-3">
    <h2>{{ $user->name }}</h2>
  </div>

  @if (Auth::check())
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
