@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      @foreach ($messages as $message)
        <div class="col-6">
          @include('messages.message')
        </div>
      @endforeach
    </div>
  </div>
@endsection
