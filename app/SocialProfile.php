<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialProfile extends Model
{
    protected $fillable = ['user_id', 'social_id'];

    public function user(){
      return $this->belongsTo(User::class);
    }
}
