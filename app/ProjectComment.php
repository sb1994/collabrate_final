<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectComment extends Model
{
    //
    protected $fillable = [
        'body', 'user_id', 'project_id','profile_img',
    ];

    public function project(){
       return $this->belongsTo(Project::class);
    }

}
