<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = ['message_id', 'user_id', 'message'];

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function message(){
      return $this->belongsTo(Message::class);
    }

}
