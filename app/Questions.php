<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{

    static function newQuestions()
    {
        return count(self::where(['state' => 0, 'block' => 0])->get());
    }
    static function blockQuestions()
    {
        return count(self::where('block', '>', 0)->get());
    }
}
