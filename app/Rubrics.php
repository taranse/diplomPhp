<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubrics extends Model
{
    public function getQuestions()
    {
        return $this->hasMany('App\Questions', 'rubric');
    }
    public function getAuthor()
    {
        return $this->belongsTo('App\User', 'author');
    }
}
