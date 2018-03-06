<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Http\Requests\CreateMessageRequest;

class MessagesController extends Controller
{
    public function show(Message $message){

      return view('messages.show', [
        'message' => $message,
      ]);
    }

    public function create(CreateMessageRequest $request){

      $image = $request->file('image');

      $message = Message::create([
        'content' => $request->message,
        'image' => $image->store('messages', 'public'),
        'user_id' => $request->user()->id,
      ]);

      return redirect('/message/' . $message->id);
    }
}
