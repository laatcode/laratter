@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>{{ $user->name }}</h1>
    @foreach ($follows as $follow)
      <li>{{ $follow->username }}</li>
    @endforeach
  </div>
@endsection
