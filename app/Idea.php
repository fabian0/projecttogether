<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Skill;

class Idea extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text', 'user_id', 'category', 'location',
    ];

    /**
     * A Idea belongs to a user.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function  buddys()
    {
        return $this->belongsToMany('App\User');
    }

    public function  requiredskills()
    {
        return $this->belongsToMany('App\Skill', 'idea_skill');
    }


}
