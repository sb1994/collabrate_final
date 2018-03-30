<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\User;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','profile_img','country','city','interest','profession','skill','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function projects()
    {
        return $this->hasMany('App\Project');
    }
    public function project_comments()
    {
        return $this->hasMany('App\Project');
    }
    public function project_ratings()
    {
        return $this->hasMany('App\ProjectRating');
    }
}
