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
      dd($request->all());
    }
}
