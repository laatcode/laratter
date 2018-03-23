@extends('layouts.app')

@section('content')
  <div class="text-center">
    <img class="img-thumbnail" src="{{ $message->image }}">
    <p class="card-text">
      {{ $message->content }}
      <small class="text-muted">{{ $message->create_at }}</small>
    </p>
    <responses :message="{{ $message->id }}"></responses>
  </div>

@endsection
