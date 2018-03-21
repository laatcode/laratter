@extends('layouts.app')

@section('content')
  <h1>{{ $user->name }}</h1>
  @foreach ($followers as $follower)
    <li>{{ $follower->username }}</li>
  @endforeach
@endsection
