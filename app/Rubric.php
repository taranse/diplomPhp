<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    public function getQuestions()
    {
        return $this->hasMany('App\Question', 'rubric');
    }
    public function getAuthor()
    {
        return $this->belongsTo('App\User', 'author');
    }
}
