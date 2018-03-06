@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Conversación con {{ $conversation->users->except($user->id)->implode('name', ', ') }}</h1>

      @foreach ($conversation->privateMessages as $message)
        <div class="card mb-3">
          <div class="card-header">
            {{ $message->user->name }} dijo ...
          </div>
          <div class="card-body">
            <p class="card-text">{{ $message->message }}</p>
            <span class="text-muted">{{ $message->created_at }}</span>
          </div>
        </div>
      @endforeach
  </div>
@endsection
