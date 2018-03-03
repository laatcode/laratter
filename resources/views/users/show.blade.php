@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>{{ $user->name }}</h1>

    <form action="/{{ $user->username }}/follow" method="post">
      <div class="form-group">
        {{ csrf_field() }}
        <button class="btn btn-primary" type="submit" name="button">Seguir</button>
      </div>
    </form>

    <div class="row">
      @foreach ($user->messages as $message)
        <div class="col-6">
          @include('messages.message')
        </div>
      @endforeach
    </div>
  </div>
@endsection
