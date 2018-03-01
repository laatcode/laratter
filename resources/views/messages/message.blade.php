<img class="img-thumbnail" src="{{ $message->image }}">
<p class="card-text">
  {{ $message->content }}
  <a href="/message/{{ $message->id }}">Leer más</a>
</p>
