@extends('layouts.app')

@section('content')

  @if (Auth::check())
    <form class="form-row mt-3" action="messages/create" method="post" enctype="multipart/form-data">
      <div class="form-group col">
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
        <div class="form-group col-1 col-lg-2">
          <label for="image" class="btn btn-primary d-none d-lg-inline-block">Seleccionar imagen</label>
          <label for="image" class="btn btn-primary d-lg-none"><span class="fas fa-camera fa-lg"></span></label>
          <input id="image" class="d-none" type="file" name="image" accept="image/*">
        </div>
      </form>
  @endif

    <div class="row @if(!Auth::check()) mt-4 @endif">
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
