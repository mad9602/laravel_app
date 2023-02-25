<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Game;
use App\Opponents;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'team', 'area', 'body', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function game()
    {
        $this->hasMany(Game::class);
    }

    public function opponents()
    {
        $this->hasMany(Opponents::class);
    }

    public function like()
    {
        return $this->hasMany('App\Like');
    }

    public function delcount()
    {
        return $this->hasMany('App\DelCount', 'user_id', 'id');
    }
}
