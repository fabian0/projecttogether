<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Idea;

class Skill extends Model
{
    protected $fillable = [
        'text',
    ];


    public function  users()
    {
        return $this->belongsToMany('App\User', 'user_skill');
    }

    public function  ideas()
    {
        return $this->belongsToMany('App\Idea', 'idea_skill');
    }
}
