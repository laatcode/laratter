<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class PagesController extends Controller
{
    public function index(){

      $messages = Message::latest()->paginate(10);

      return view('welcome', [
        'messages' => $messages
      ]);

    }
}
