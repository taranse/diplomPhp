<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $fillable = ['name', 'author', 'email', 'rubric', 'text', 'alias', 'state', 'block'];


    static function newQuestions()
    {
        return count(self::where(['state' => 0, 'block' => 0])->get());
    }

    static function blockQuestions()
    {
        return count(self::where('block', '>', 0)->get());
    }

    public function getRubric()
    {
        return $this->belongsTo('App\Rubric', 'rubric');
    }

    public function getUser()
    {
        return $this->belongsTo('App\User', 'admin');
    }

    public function scopeActive($query)
    {
        return $query->where(['state' => 1, 'block' => 0]);
    }

    public function scopeNewItems($query)
    {
        return $query->where(['state' => 0, 'block' => 0]);
    }

    public function scopeBlock($query, $block = 0)
    {
        return $query->where('block', '>', $block);
    }

    public function scopeFiveItems($query)
    {
        return $query->orderBy('created_at', 'desc')->paginate(5);
    }

}
