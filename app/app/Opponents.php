<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opponents extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function game()
    {
        return $this->hasOne('App\Game');
    }
}
