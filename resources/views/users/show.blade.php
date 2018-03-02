@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>{{ $user->name }}</h1>

    <div class="row">
      @foreach ($user->messages as $message)
        <div class="col-6">
          @include('messages.message')
        </div>
      @endforeach
    </div>
  </div>
@endsection
