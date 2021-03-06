<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conversation;
use App\PrivateMessage;
use App\Notifications\UserFollowed;
use App\Notification;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    private function findByUsername($username){
      return $user = User::where('username', $username)->firstOrFail();
    }

    public function show($username){
      $user = $this->findByUsername($username);

      return view('users.show', [
        'user' => $user,
      ]);
    }

    public function follow($username, Request $request){
      $user = $this->findByUsername($username);

      $me = $request->user();
      $me->follows()->attach($user);

      $user->notify(new userFollowed($me));

      return redirect("/$username")->withSuccess('Usuario seguido!');

    }

    public function unfollow($username, Request $request){
      $user = $this->findByUsername($username);

      $me = $request->user();
      $me->follows()->detach($user);

      return redirect("/$username")->withSuccess('Usuario no seguido!');

    }

    public function follows($username){
      $user = $this->findByUsername($username);

      return view('users.follows', [
        'user' => $user,
        'follows' => $user->follows,
      ]);
    }

    public function followers($username){
      $user = $this->findByUsername($username);

      return view('users.followers', [
        'user' => $user,
        'followers' => $user->followers,
      ]);
    }

    public function sendPrivateMessage($username, Request $request){
      $user = $this->findByUsername($username);

      $me = $request->user();
      $message = $request->message;

      $conversation = Conversation::between($me, $user);

      $privateMessage = PrivateMessage::create([
        'conversation_id' => $conversation->id,
        'user_id' => $me->id,
        'message' => $message,
      ]);

      return redirect('/conversations/' . $conversation->id);
    }

    public function showConversation(Conversation $conversation){
      $conversation->load('users', 'privateMessages');

      return view('users.conversation', [
        'conversation' => $conversation,
        'user' => auth()->user(),
      ]);
    }

    public function notifications(Request $request){
      return $request->user()->notifications;
    }

    public function readNotification(Notification $notification){
      $notification->update(['read_at' => now()]);
    }

    public function readNotifications(){
      return Auth::user()->notifications->markAsRead();
    }

    public function deleteNotifications(){
      return Auth::user()->notifications()->delete();
    }

    public function deleteNotification(Notification $notification){
      $notification->delete();
    }
}
