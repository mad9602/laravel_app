<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    public function like()
    {
        return $this->hasMany('App\Like', 'user_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function opponents()
    {
        return $this->belongsTo('App\Opponents');
    }
}
