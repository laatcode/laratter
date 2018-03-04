@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>{{ $user->name }}</h1>
    @foreach ($followers as $follower)
      <li>{{ $follower->username }}</li>
    @endforeach
  </div>
@endsection
