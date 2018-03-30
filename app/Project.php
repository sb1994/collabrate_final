<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'cover_img','user_id','category_id'
    ];
  public function user(){
     return $this->belongsTo(User::class);
  }
  public function comments()
  {
      return $this->hasMany('App\ProjectComment');
  }
  public function project_ratings()
  {
      return $this->hasMany('App\ProjectRating');
  }
}
