@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>{{ $user->name }}</h1>

    @if (Auth::check())
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

    <div class="row">
      @foreach ($user->messages as $message)
        <div class="col-6">
          @include('messages.message')
        </div>
      @endforeach
    </div>
  </div>
@endsection
