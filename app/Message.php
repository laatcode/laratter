<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function getImageAttribute($image){
      if(!$image || starts_with($image, 'http')){
        return $image;
      }else {
        return \Storage::disk('public')->url($image);
      }
    }
}
