<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use App\SocialProfile;
use App\Http\Requests\CreateSocialProfileRequest;

class SocialAuthController extends Controller
{
    public function facebook(){
      return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback(){
      $user = Socialite::driver('facebook')->user();

      $existing = User::whereHas('socialProfiles', function ($query) use ($user){
        $query->where('social_id', $user->id);
      })->first();

      if($existing != null){
        auth()->login($existing);

        return redirect('/');
      }

      session()->flash('socialProfile', $user);

      return view('users.facebook', [
        'user' => $user,
      ]);
    }

    public function github(){
      return Socialite::driver('github')->redirect();
    }

    public function githubCallback(){
      $user = Socialite::driver('github')->user();

      $existing = User::whereHas('socialProfiles', function ($query) use ($user){
        $query->where('social_id', $user->id);
      })->first();

      if($existing != null){
        auth()->login($existing);

        return redirect('/');
      }

      session()->flash('socialProfile', $user);

      return view('users.facebook', [
        'user' => $user,
      ]);

    }

    public function register(CreateSocialProfileRequest $request){
      $data = session('socialProfile');
      $name = $request->name;
      $email = $request->email;
      $username = $request->username;

      $user = User::create([
        'name' => $name,
        'username' => $username,
        'email' => $email,
        'password' => str_random(16),
        'avatar' => $data->avatar,
      ]);

      $profile = SocialProfile::create([
        'social_id' => $data->id,
        'user_id' => $user->id,
      ]);

      auth()->login($user);

      return redirect('/');
    }
}
