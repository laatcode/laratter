@extends('layouts.app')

@section('content')
  <div class="jumbotron text-center">
    <h1>Laratter</h1>
    <nav >
      <ul class="nav nav-pills">
        <li class="nav-item">
          <a class="nav-link" href="/">Inicio</a>
        </li>
      </ul>
    </nav>
  </div>

  @if (Auth::check())
    <div class="row">
      <div class="col">
        <form action="messages/create" method="post" enctype="multipart/form-data">
          <div class="form-group">
            {{ csrf_field() }}
            <input type="text" name="message" class="form-control @if($errors->has('message')) is-invalid @endif" placeholder="¿Qué estás pensando?">
              @if ($errors->has('message'))
                @foreach ($errors->get('message') as $error)
                  <div class="invalid-feedback">
                    {{ $error }}
                  </div>
                @endforeach
              @endif
            </div>
            <div class="form-group">
              <label for="image" class="btn btn-primary">Seleccionar imagen</label>
              <input id="image" class="d-none" type="file" name="image" accept="image/*">
            </div>
          </form>
        </div>
      </div>
    @endif

    <div class="row">
      @forelse ($messages as $message)
        <div class="col-6">
          @include('messages.message')
        </div>
      @empty
        <p>No hay mensajes destacados</p>
      @endforelse
    </div>
    @if ($messages)
      <div class="mt-3 d-flex justify-content-center">
        {{ $messages->links() }}
      </div>
    @endif
@endsection
