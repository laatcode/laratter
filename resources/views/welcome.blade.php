@extends('layouts.app')

@section('content')
  <div class="jumbotron text-center">
    <div class="container">
      <h1>Laratter</h1>
      <nav >
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link" href="/">Inicio</a>
          </li>
        </ul>
      </nav>
    </div>
  </div>

  <div class="container">
    <div class="row">
      @forelse ($messages as $message)
        <div class="col-6">
          <img class="img-thumbnail" src="{{ $message['image'] }}">
          <p class="card-text">
            {{ $message['content'] }}
            <a href="/message/{{ $message['id'] }}">Leer más</a>
          </p>
        </div>
      @empty
        <p>No hay mensajes destacados</p>
      @endforelse
    </div>
  </div>
@endsection
