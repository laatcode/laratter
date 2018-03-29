@if (Auth::check())
  @if (Gate::allows('bothFollowers', $user))
    <form class="form-row form-group" action="/{{ $user->username }}/dms" method="post">
      {{ csrf_field() }}
      <div class="col-10">
        <input class="form-control" type="text" name="message">
      </div>
      <div class="col-2">
        <button class="btn btn-success" type="submit">Enviar mensaje privado</button>
      </div>
    </form>
  @endif
@endif

<div class="row">
  @foreach ($user->messages as $message)
    <div class="col-6">
      @include('messages.message')
    </div>
  @endforeach
</div>
