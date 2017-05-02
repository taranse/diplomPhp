<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

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
}
