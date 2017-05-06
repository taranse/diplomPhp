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

    public function scopeAlias($query, $alias)
    {
        return $query->where('alias', $alias)->firstOrFail();
    }

    public function scopeActiveQuestions($query)
    {
        return $query->getQuestions()->where('state', 1);
    }
}
