<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'like_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'like_id', 'id');
    }

    public function exist($user_id, $like_id)
    {
        return Like::where('user_id', $user_id)->where('like_id', $like_id)->exists();
    }
}
