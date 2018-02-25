<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class PagesController extends Controller
{
    public function index(){

      $messages = Message::all();

      return view('welcome', [
        'messages' => $messages
      ]);

    }
}
